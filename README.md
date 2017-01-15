# XBTIT Blu-Edition by BluCrew v1.1.05 [![Awesome](https://cdn.rawgit.com/sindresorhus/awesome/d7305f38d29fed78fa85652e3a63e154dd8e8829/media/badge.svg)](https://gitter.im/XBTIT-Blu-Edition/Lobby)
> A modern front and backend bittorrent tracker!



Demo Site: http://blu-edition.hdinnovations.xyz/index.php<br>
Username: Demo <br>
Pass: Demo123.

Gitter Page: https://gitter.im/XBTIT-Blu-Edition/Lobby#
<i>Come chat with us!</i>

<br>
<br>
## NOTE: INSTALLER IS NOT YET COMPLETE!!!!!
You can use the demo db dump if you want to play around until installer is complete!
https://www.dropbox.com/s/lt6fitfuysxcaav/Demo_DB.sql?dl=0


<b>:REQUIREMENTS:</b>
- Web server with NGINX (Apache can be used but not recommended)<br>
- A valid domain<br>
- PHP 7.X+ Recommended (PHP 5.4+ minimum)<br>
- Dependencies for PHP, (Updated as issues spotted)
  -   php-gettext -> This is primarly for phpmyadmin, if your going to use it, there has been cases where it does not install when installing phpmyadmin.
  -   php-curl    -> This is specifically needed for the Various API's we have running.
- MySQL 5.7+ or MariaDB 10+ (At this time you must disable Strict-Mode. MySQL and MariaDB are enabled by default in MySQL 5.7 and MariaDB 10)<br>

<b>:DOCUMENTATION:</b><br>
<i>PHP TRACKER AND INTERNAL FORUM <br>
This is the easiest and fastest way to get your tracker up and running!</i>
<br>
- Place the xbtitFM Blu-Edition code in your webroot<br>
- Create your database (utf8_unicode_ci) and a database user using your application of choice like phpMyAdmin. Grant your database user usage privileges (data+structure, not grant/administration)<br>
- Use a web browser to open the site<br>
- Follow the instructions displayed by the installer<br>
- Once install is complete delete the install.php from your server<br>
- Log into your new site with the username and password you created during the install process<br>
- Enter the admin control panel and set your tracker's URL and announce URL's (delete the example announce with the :2710) and set your preferences and then save the settings.<br>
- Take some time to go through the admin panel and get used to everything from settings, hacks, modules and more.<br>
- Enjoy!<br>

<b>:GENERAL NOTES:</b><br>
- Look to your Users Group Settings, do they match what you want?<br>
- You need to create the boards for your internal forum.<br>
- It is a lot of new stuff to take in, any bugs please open a issue on git.<br>

<b>:CREDITS:</b><br>
- BluCrew (HDVinie and MrG01)<br>
- Our Collaborators (flier56, Chocolatkey, nilimahona)<br>
- This script takes the best of XBTIT, XBTITFM, XBTIT DT FM and XBTIT DT DC so credit to all the developers and participents in those named scripts. (That being said XBTIT Blu-Edition is still very much different but without XBTIT CORE this script would not be availble so giving credit where credit is due!)<br>
<br>

#
### UPDATES

```
  v1.0      - Initial Release
  v1.1      - API class to handle Posters, Banners, CD Art and Background images from TVDB and FanArt
  v1.1.03   - Fixes cache issue relating to OMDB
  v1.1.04   - Minor fixes to bugs relating to list and details pages
  v1.1.05   - Fixes to language, Multiple Style Updates, Global Seedbonus Multiplier Hack Added  
```


### COMPONENTS USED
* [jquery](https://jquery.com)
* [icheck](http://icheck.fronteed.com)
* [Bootstrap-Switch](http://www.bootstrap-switch.org)
* [Bootstrap](http://getbootstrap.com)
* [FontAwesome](http://fontawesome.io)
* [FanArt API](https://fanart.tv)
* [TMDB API](https://www.themoviedb.org)
* [OMDB API](http://omdbapi.com)

### LICENSE
```
The MIT License (MIT)

Copyright (c) 2016 BluCrew

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
```

### Enforcement

Instances of abusive, harassing, or otherwise unacceptable behavior may be
reported by contacting the project team at Mr.Robot@stealth.tg. All
complaints will be reviewed and investigated and will result in a response that
is deemed necessary and appropriate to the circumstances. The project team is
obligated to maintain confidentiality with regard to the reporter of an incident.
Further details of specific enforcement policies may be posted separately.

Project maintainers who do not follow or enforce the Code of Conduct in good
faith may face temporary or permanent repercussions as determined by other
members of the project's leadership.