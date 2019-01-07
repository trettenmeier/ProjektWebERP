# ProjektWebERP
<h1>Description</h1>
Private project to automate certain tasks at my workplace (documentation, credit transfer - create pdf-Files with banking details, store and retrieve information about clients, etc.)
<br><br>
This Web-Application is built with PHP (Laravel-Framework) and MySQL to run on a Linux server. Some parts are Copyrighted/Licenced (especially the INSPINIA-Bootstrap Theme).


<h1>Notes</h1>
Comments and content is completly in German.
<br><br>
Relevant Files are mostly in:
- /App/Http/Controllers/
- /App/Http/Helpers/
- /App/Http/
- /routes/web.php
- /resources/views
- /public/modul_ueberweisung
- SQL-Tables are saved as a SQL-Script in sql_snapshot.sql

<h1>Status</h1>
Functional parts:
- credit transfer
- dashboard
- user administration
- client administration
- documentation (mostly, except "show archived" clients)

<h1>Todo:</h1>
- Git: Unentangle the actual code from the Laravel framework
- Show archived view in the documentation module
