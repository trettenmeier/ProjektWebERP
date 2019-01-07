<?php
/**
 * Created by PhpStorm.
 * User: T. Rettenmeier
 * Date: 26.03.2017
 * Time: 22:17
 */

namespace App\Http\Controllers;


class PdfGenerate
{
    /*
   * Path to raw PDF form
   * @var string
   */
    private $pdfurl;
    /*
    * Form data
    * @var array
    */
    private $data;
    /*
    * Path to filled PDF form
    * @var string
    */
    private $output;
    /*
    * Flag for flattening the file
    * @var string
    */
    private $flatten;
    /**
     * Class Conctructor
     */
    public function __construct($pdfurl, $data)
    {
        $this->pdfurl = $pdfurl;
        $this->data   = $data;
    }
    /**
     * Generate a filled PDF file
     *
     */
    private function generate()
    {
        $fdf = $this->makeFdf($this->data);
        $this->output = $this->tmpfile();
        exec("pdftk \"{$this->pdfurl}\" fill_form \"{$fdf}\" output \"{$this->output}\"{$this->flatten}");
        unlink($fdf);
    }
    /**
     * Extract fields information
     *
     * @param boolean $pretty
     * @return string
     */
    public function fields($pretty = false)
    {
        $tmp = $this->tmpfile();
        exec("pdftk {$this->pdfurl} dump_data_fields > {$tmp}");
        $con = file_get_contents($tmp);
        unlink($tmp);
        return $pretty == true ? nl2br($con) : $con;
    }
    /**
     * Generate FDF file
     * @param array $data
     * @return string
     */
    public function makeFdf($data)
    {
        $fdf = '%FDF-1.2
        1 0 obj<</FDF<< /Fields[';
        foreach ($data as $key => $value) {
            $fdf .= '<</T(' . $key . ')/V(' . $value . ')>>';
        }
        $fdf .= "] >> >>
        endobj
        trailer
        <</Root 1 0 R>>
        %%EOF";
        $fdf_file = $this->tmpfile();
        file_put_contents($fdf_file, $fdf);

        return $fdf_file;
    }
    /**
     * Set the flatten flag
     *
     * @return pdfGenerate
     */
    public function flatten()
    {
        $this->flatten = ' flatten';
        return $this;
    }

    /**
     * Save the file
     *
     * @param string $path
     * @return $this
     */
    public function save($path = null)
    {
        if (is_null($path)) {
            return $this;
        }
        if (!$this->output) {
            $this->generate();
        }
        $dest = pathinfo($path, PATHINFO_DIRNAME);
        if (!file_exists($dest)) {
            mkdir($dest, 0775, true);
        }
        copy($this->output, $path);
        unlink($this->output);
        $this->output = $path;
        return $this;
    }
    /**
     * Force download the filled PDF file
     *
     */
    public function download()
    {
        if (!$this->output) {
            $this->generate();
        }
        $filepath = $this->output;
        if (file_exists($filepath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename=' . uniqid(gethostname()) . '.pdf');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filepath));
            readfile($filepath);
            exit;
        }
    }
    /**
     * Create a temporary file and return the name
     *
     * @return string
     */
    private function tmpfile()
    {
        return tempnam(sys_get_temp_dir(), gethostname());
    }

    /**
     * @param mixed $output
     */
    public function setOutput($output)
    {
        $this->output = $output;
    }

}