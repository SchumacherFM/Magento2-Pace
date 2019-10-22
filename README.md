Magento2-Pace
============

Magento2 Pace - Automatic page load progress bar for the backend and frontend.

Pace will automatically monitor your ajax requests, event loop lag, document ready state, and elements on your
page to decide the progress. On ajax navigation it will begin again!

Based on [https://github.com/HubSpot/pace](https://github.com/HubSpot/pace)

Demo [http://github.hubspot.com/pace/docs/welcome/](http://github.hubspot.com/pace/docs/welcome/)

Theme is configurable in the backend section System -> Configuration -> Advanced -> System -> Pace.

Backend Integration
-------------------

A plugin has been created to after intercept the toHtml() method in `\Magento\Backend\Block\Page\RequireJs`.
That is the only way to integrate pace directly after the `<head>` tag. Pace CSS/JS will be cached.

Frontend Integration
--------------------

@todo because internal Mage2 code states: Temporary solution

Tests
-----

@todo once calling phpunit will not take aeon.

Installation via Composer
------------

Please run below commands in sequence

1. composer require schumacherfm/mage2-pace
2. php bin/magento setup:upgrade
3. php bin/magento static:content:generate
4. php bin/magento setup:di:compile

Compatibility
-------------

- Magento >= 2
- php >= 5.5.0

Support / Contribution
----------------------

Report a bug using the issue tracker or send us a pull request.

Instead of forking I can add you as a Collaborator IF you really intend to develop on this module. Just ask :-)

I am using that model: [A successful Git branching model](http://nvie.com/posts/a-successful-git-branching-model/)

For versioning have a look at [Semantic Versioning 2.0.0](http://semver.org/)

History
-------

#### 0.2.0

- Compatible to Magento 2 GA 2.0.0
- PHP7 compatible

#### 0.1.0

- pace.js to 1.0.2
- Initial release

License
-------

The MIT License (MIT)

Copyright (c) 2013-2016 Cyrill Schumacher

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
