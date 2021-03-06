<p align="center">
    <h1 align="center">Arbel</h1>
    <br>
</p>

Brief description: Dashboard to manage tasks, users and status of a certain task.

DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      mail/               contains view files for e-mails
      models/             contains model classes
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources



REQUIREMENTS
------------

The minimum requirement by this project template is that your Web server supports PHP 5.4.0. The recomended version is 7.1
You may also need a basic Apache + MySQL setup.
For advanced mac users we recommend that you follow this setup (part 1 and 2).
<a href="https://getgrav.org/blog/macos-mojave-apache-multiple-php-versions">Homebrew + Apache + MySQL</a>
For an easy experience you alternatively may use MAMP or XAMP, depending on your operative system.


INSTALLATION
------------

Clone this repository or download de .zip file into your web root directory.

~~~
git clone git@github.com:dianam2r/arbel.git
~~~

Set cookie validation key in `config/web.php` file to some random secret string (there's one within installation but you may change it if you want to) :

```php
'request' => [
    // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
    'cookieValidationKey' => '<secret random string goes here>',
],
```

ADDITIONAL CONFIGURATIONS
-------------

- You will have to create the database, this has to be done manually before you can access it.
- This appliaction connects to arbel_api, so you have to also download the repo in your web root in order to get access to db info, very much needed in the application.

~~~
git clone git@github.com:dianam2r/arbel_api.git
~~~

You can then access the application through the following URL:

~~~
http://localhost/arbel/web/
~~~

Note: if previous step didn't work, open a terminal and within the application directory type this command

```
php yii serve
```

If you have followed the previous steps, to log into the application there are to users from the start. Same password as the username, they are:
- dianamar
- arbel_demo