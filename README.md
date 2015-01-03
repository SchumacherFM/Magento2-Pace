Magento2-Pace
============

Magento2 Pace - Automatic page load progress bar for the backend and frontend.

Pace will automatically monitor your ajax requests, event loop lag, document ready state, and elements on your
page to decide the progress. On ajax navigation it will begin again!

Based on [https://github.com/HubSpot/pace](https://github.com/HubSpot/pace)

Demo [http://github.hubspot.com/pace/docs/welcome/](http://github.hubspot.com/pace/docs/welcome/)

Theme is configurable in the backend section System -> Configuration -> Advanced -> System -> Pace.

@todo frontend integration
 
Installation via Composer
------------

add the following to the require section of your Magento 2 `composer.json` file

    "schumacherfm/mage2-pace": "dev-master"

additionally add the following in the repository section

        "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/SchumacherFM/Magento2-Pace.git"
        }
    ]
    
run `composer update`

add the following to `app/etc/config.php`

    'SchumacherFM_Pace'=>1

Compatibility
-------------

- Magento >= 2
- php >= 5.4.0

Support / Contribution
----------------------

Report a bug using the issue tracker or send us a pull request.

Instead of forking I can add you as a Collaborator IF you really intend to develop on this module. Just ask :-)

I am using that model: [A successful Git branching model](http://nvie.com/posts/a-successful-git-branching-model/)

For versioning have a look at [Semantic Versioning 2.0.0](http://semver.org/)

History
-------

#### 0.1.0

- pace.js to 1.0.2
- Initial release

License
-------

The MIT License (MIT)

Copyright (c) 2013 Cyrill Schumacher

Permission is hereby granted, free of charge, to any person obtaining a copy of
this software and associated documentation files (the "Software"), to deal in
the Software without restriction, including without limitation the rights to
use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of
the Software, and to permit persons to whom the Software is furnished to do so,
subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS
FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER
IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN
CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

Author
------

[Cyrill Schumacher](http://cyrillschumacher.com)

[My pgp public key](http://www.schumacher.fm/cyrill.asc)
