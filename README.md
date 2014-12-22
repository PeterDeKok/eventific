#Eventific

Event Management system for event managers and event explorers.

##Sync with repository
1. Create gitHub account.
2. Send username to Peter.
3. Download gitHub GUI and login with your gitHub account:
    - [Windows](windows.gihub.com)
    - [OS X](mac.github.com)
4. Once added to the repository, clone the repository from github (+ sign at top left).
5. Create a new branch for new features and merge it back to master once it is done.
6. Don't forget to Sync your local repository to the gitHub repository at every logical moment.

##Database settings
1. Install MySQL.
2. Login as root.
3. Run the [eventific/webtechgroup5.sql](eventific/webtechgroup5.sql) on your database. 
4. Create a new user:
    - Username: webtech
    - Password: KKll55
5. Give it (at least) SELECT, INPUT and UPDATE privileges to this user, on the webtechgroup5 database (and every tables in it) @ localhost or 127.0.0.1 (depending on your setup).

##Server settings
1. Make sure the wwwroot folder in the repository is your document root folder of your server setup.
2. This will make sure that all other folders and files in the first level of the repository will be protected against direct access.

##Configure Secure Sessions
1. Create Database table and seperate user and limit it's permissions. (see secureSessionDB.sql)
2. Install MCrypt extension for php (if not installed)
    - [Windows](http://www.myoddweb.com/2010/11/18/install-mcrypt-for-php-on-windows/)
    - [OS X](http://coolestguidesontheplanet.com/install-mcrypt-php-mac-osx-10-10-yosemite-development-server/)

#Facebook Login:
1. Alter the table members: ALTER TABLE `members` ADD `fbid` VARCHAR(128) NOT NULL DEFAULT '0' ;
2. When you log in to facebook, you get redirected to eventific.dev/......., you have to change this to your local host. For example: locahost:8080/......
3. Once logged in, there should be a line of text below "Welcome to your Eventific account ....". There are three log in types: Default (site only), FB or Both.
4. There are variables stored in the session for lots of things, i think all of them are pretty clear.

$_SESSION['user_friends'] = $result;
$_SESSION['valid'] = true;
$_SESSION['timeout'] = time();
$_SESSION['FB'] = true;
$_SESSION['username'] = $graphObject['name'];
$_SESSION['id'] = $graphObject['id'];
$_SESSION['first_name'] = $graphObject['first_name'];
$_SESSION['last_name'] = $graphObject['last_name'];
$_SESSION['gender'] = $graphObject['gender'];
$_SESSION['email'] = $graphObject['email'];

