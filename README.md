wikijournals-server
===================

Description
-----------

Wikijournals-server is a web application, based on Semantic Mediawiki. This application allow collecting articles, publishers, publications and authors in a semantic database. The following functions are available:

- Saving semantic attributes for articles like persons, companies and locations
- Searching for articles, publications, publishers and authors by using semantic attributes
- Basic social network functions for registered users (f.e. user board for sending internal messages)

Requirements
------------
- Webserver: Apache > 2.0
- Database: MySQL > 5.0.2
- Scripting Language: PHP > 5.2.3
- Minimum space on server: 200 MB

Installation
------------

For the installation of wikijournals on your own webserver please execute the following steps:

- Download the full package from github (the complete wikijournals directory)
- Copy the wikijournals directory onto the htdocs directory of your webserver
- Note: The directory wikijournals\images must be writable for the webserver (including all subdirectories) 
- Start the webserver and the database server, if the are not on
- Create a database and a database user for wikijournals (you can also use the root user, but this is not recommended)
- Call the url <www-root>/wikijournals/installation in the browser
- Follow the installation steps of the installer
- If the installer ends succesfully please copy the LocalSettings.php from the config directory of the installation directory into the main wikijournals directory
- Now you can start wikijournals by calling the url <www-root>/wikijournals
- Please note: The default password of the Administrator account (Login:Administrator) is "wikijournals". We recommend changing this password after first login !!
