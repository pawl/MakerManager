Maker-Manager
=============

Maker Manager was developed to solve administrative challenges for Dallas Makerspace.

It features the following:
* A self-documenting place to activate and deactivate badges.
* A web interface for Dallas Makerspace's access control system.
* An API, so our billing system can automatically deactivate and activate badges when there is a need.
* Integration with our billing system's database for getting user information.

#### Setup
You will need to have WHMCS installed. If you don't have WHMCS installed, you will need to rewrite a lot of the code to rely on some other database for user information.

Create a MySQL database called "dms_crm" and import the database schema for the "tbl_badges" table located in protected/data/badges.sql.

The file accessControlWebservice.py in protected/data/ needs to be placed on the server connected to the access controller. It's a webserver that Maker Manager communicates with ication with the access controller. A quick way to make sure it's running at startup is by creating a cronjob for it with the @reboot command.

#### Technical
Maker Manager is built using a PHP framework called Yii and it uses a MySQL database. The frontend was mostly done using Twitter Bootstrap. The parts which interact with the access control system are written in Python.
