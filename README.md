Client API
----------
**client** is a web application which designed to directly work with API. This works as a data consumer. It consumes data from your API. So this would be your own website which works as a Client of your API. Using Password or Client Credentials grant, **client** application sends a POST request for user authentication to the API with username and password values. 

**Caution:** This only works with this repo <a href="https://github.com/unclexo/server">server</a> which would be your Server API for resources. To get a complete applicatoin this needs to be set up too.

Installation
------------

Just clone the repository and run `composer` as follows:

```bash
cd path/to/project/dir
git clone git://github.com/unclexo/client.git
cd client
php composer.phar install
```

Alternately, download the repo to some directory and run `composer` as follows:

```bash
cd path/to/project/dir
php composer.phar install
```

Web Server Setup
----------------

### Apache Setup

To setup apache, setup a virtual host to point to the public/ directory of the
project. It should look something like below:

```
<VirtualHost *:80>
  ServerName client.dev
  DocumentRoot /path/to/client/public
  <Directory /path/to/client/public>
    DirectoryIndex index.php
    AllowOverride All
    Require all granted
  </Directory>
</VirtualHost>
```

What More Needs to Be Done
--------------------------

You must set up another repo as your Server API named <a href="https://github.com/unclexo/server">server</a> to make **client** repo work correctly. So please <a href="https://github.com/unclexo/server">go over there</a> and set up things as said there.

License
-------

**client** is provided under the MIT license.


Contributing
------------

If you found a mistake or a bug, please report it using the <a href="https://github.com/unclexo/client/issues">Issues</a> page. Your feedback is highly appreciated.