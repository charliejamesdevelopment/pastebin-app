**I still have yet to go through and remove unused variables, and stuff like that. Won't affect the end user but is needed.
Register is currently disabled, will fix it soon. **

# pastebin-app
Created this application originally for personal use. However I thought people could use it for a base to develop their own, or even use this app as their own. Please do as you wish with it but make sure to give credit to me!

The application itself features a login / register system with a filter to stop any bad words from being posted. The code is also syntaxed when posted, so viewers can read it more effectively.

Contact me here: [Charlie James Development](https://charliejames.me)

# Installation
This application requires PHP 5.6.1 or greater with a MySQL database to store the users and pastes themselves.

This will clone the github repo into a folder called *pastebin-app* where ever you clone it.
```terminal
$ git clone https://github.com/charliejamesdevelopment/pastebin-app pastebin-app
```

The project itself only depends on the follow:
- Web Server
- PHP
- MySQL Database
*And thats it!* 

*For users who have an SSL certificate, this application is also compatible*

To configure database settings, head to */php/config/database.php*, you'll be met with a file like:
```php
<?php

$servername = "localhost"; // Insert server name here
$username = "username"; //  Insert mysql user
$password = "password"; // Insert mysql user's password
$dbname = "sql"; //  Insert database name

?>
```
Simply insert your database details, and the application will do the rest for you.

As for logo configuration, head to */php/config/config.php*, you'll be met with another file like:
```php
<?php

$logo_url = "https://charliejames.me/images/logo_purple.png";

?>
```
Simply enter your logo url (use a image service like [Imgur](https://imgur.com) for the logo) and you're set. No compiler, no frameworks, just vanilla PHP.

# Features
- Login (username, password)
- Register with Google's InvisiCaptcha (invisible user verification)
- Multiple paste languages, can add more (request more in the issues tab above)
- Automatic table creation
- Censored words when posting paste
- Syntax highlighting when viewing paste

**REQUEST MORE in the ISSUE tab!**
