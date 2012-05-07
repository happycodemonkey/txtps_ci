Rewrite of the Texas Test Problem Server
1) Moved to Codeignite framework
2) Utilizing Ion Auth

To install simply clone this repo into your server root, and modify config.php
to reflect your correct base_uri (very important!).

Also make sure that mod_rewrite is allowed, and AllowOverride is set to all in httpd.conf

@TODO:
- Remake Schema: after testing install new schema (fresh db)
- Replace 404's with actual errors/redirect to login re: user access
- Generator add: add a go-back button between steps
- Build edit pages
- Error messaging: required fields
- Check that arguments are the correct type
- Adding files to generators/problems
- Ensure that pages have correct permissions
