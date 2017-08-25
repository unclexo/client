Client API
----------
**client** is a web application which designed to directly work with API. This works as a data consumer. It consumes data from your API. So this would be your own website which works as a Client of your API. Using Password or Client Credentials grant, **client** application sends a POST request for user authentication to the API with username and password values. 

**Caution:** This only works with this repo <a href="https://github.com/unclexo/server">server</a> which would be your Server API for resources. So this must be ready too!

Installation
------------

Download the repo to some directory and run `composer` as follows:

```bash
cd path/to/project/dir
php composer.phar install
```

Alternately, clone the repository and run `composer` as follows:

```bash
cd path/to/project/dir
git clone git://github.com/unclexo/client.git
cd client
php composer.phar install
```

Web Server Setup
----------------

### Apache Setup

**client** expects server name as `server.dev`.

To setup apache, setup a virtual host to point to the public/ directory of the
project. It should look something like below:

```
<VirtualHost *:80>
  ServerName server.dev
  DocumentRoot /path/to/server/public
  <Directory /path/to/server/public>
    DirectoryIndex index.php
    AllowOverride All
    Require all granted
  </Directory>
</VirtualHost>
```

If you do not set up the `ServerName` to `server.dev` while creating virtual host, you have to change your preferred server name only in two places in two files. So please search for `server.dev` in the following files and replace them with your own one:

```
  module/Common/src/Common/Client/ApiClient.php
  module/User/src/User/Entity/UserEntity.php
```

License
-------

**client** is provided under the MIT license.


Contributing
------------

If you found a mistake or a bug, please report it using the <a href="https://github.com/unclexo/client/issues">Issues</a> page. Your feedback is highly appreciated.