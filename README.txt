Rewrite of the Texas Test Problem Server
1) Moved to Codeignite framework
2) Utilizing Ion Auth

To install simply clone this repo into your server root, and modify config.php
to reflect your correct base_uri (very important!).

Also make sure that mod_rewrite is allowed, and AllowOverride is set to all in httpd.conf

@TODO:
- Running the generator/problem!
- How are the images, files, etc that are generated stored?
