Rewrite of the Texas Test Problem Server
1) Moved to Codeignite framework
2) Utilizing Ion Auth

To install simply clone this repo into your server root, and modify config.php
to reflect your correct base_uri (very important!).

Structure
* Strict MVC
* Seperated by user level as well...
	- Manage : Admin Pages *ONLY*
	- View : General User Pages

@TODO:
- Remake Schema
- Replace 404's with actual errors/redirect to login re: user access
- Generator add: add a go-back button between steps
- Build edit pages
