# Bootstrap Contact Form
Bootstrap 5 is to be expected to come without jQuery. All functions will be written in plain JavaScript.  

This Contact form has a simple math captcha and is ready for bootstrap 4/5 - No jQuery is needed for the form itself!
It is tested with Bootstrap 4.x. All JavaScript functions are written in plain JavaScript.  
  
Now ready for dark mode!

## Getting Started

Clone the repository or download the zip file.

### Installing

Copy or move the content of this repository to your local web project. Keep the directory structure or you need to change all internal links to the needed files.  

Configure the **index.php** file to your language preference.  
Available are German and English.  

- Set the correct timezone. If you don't know your timezone have a look [here][1].
- Set **$toName** to your name.
- Set **$toEmail** to your email address.
- Set **$subject** to your preferred subject line.
- Set **$lang** for your preferred language.  

**$date** and **$time** are preset for international use.

```
// ---------------------------------------------------------------------------------------------------------------------
// ---- User settings --------------------------------------------------------------------------------------------------

if (ini_get('date.timezone') !== 'America/New_York') date_default_timezone_set('America/New_York');
# if (ini_get('date.timezone') !== 'Europe/Berlin') date_default_timezone_set('Europe/Berlin');

$date = date("d.M.Y");   // Date eMail was sent
$time = date("H:i");     // Time eMail was sent

$toName  = 'Freddy Friday';     // Don't forget to change your name ...
$toEmail = 'freddy@friday.net'; // ... and email address!
$subject = 'Message from your website'; // And perhaps the subject.

$lang = 'en';
# $lang = 'de';

// ---- /User settings -------------------------------------------------------------------------------------------------
// ---------------------------------------------------------------------------------------------------------------------
```

The email is designed as html email. If this is not what you want, have a look [here][2]. There are several examples on how to use the **mail** function in PHP. Including text-only examples.  

Finally have a look into the **HTML section** at the end of index.php. Starting with:

```
// --- create the web page ---------------------------------------------------------------------------------------------
echo <<<HTML
``` 
 
Maybe you want to change the page title:

```
<title>contact template</title>
```

and the headlines.

```
<h2>Contact Us</h2>
<h5>Feel free to reach out for any questions!</h5>
```

## Screenshots

![Empty light form][image-1]
![Empty dark form][image-2]

<hr>

![Filled light form][image-3]
![Filled dark form][image-4]

## Built With

* [jQuery][6] - Fast, small, and feature-rich JavaScript library.
* [Bootstrap 4][3] - Sleek, intuitive, and powerful front-end framework for faster and easier web development.
* [Font Awesome 5][5] - The web's most popular icon set and toolkit.

## Contributing

Please read [Contributing.md](Contributing.md) for details on our code of conduct, and the process for submitting pull requests to us.

## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/DeltaOS2/bootstrap-contact-form/tags).

## Author

* **Gert Massheimer** - *Initial work* - [DeltaOS2](https://github.com/DeltaOS2)

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details

## History

2019-11-25 - Initial release for Bootstrap v4.x / v5.x


[1]:http://php.net/manual/fa/timezones.php
[2]:http://php.net/manual/en/function.mail.php
[3]:https://getbootstrap.com
[4]:https://github.com/DeltaOS2/bootstrap4-contact-form/Contributing.md
[5]:https://fontawesome.com
[6]:http://jquery.com

[image-1]:screenshots/lightMode.png?raw=true
[image-2]:screenshots/darkMode.png?raw=true
[image-3]:screenshots/filledLight.png?raw=true
[image-4]:screenshots/filledDark.png?raw=true
