<?php
//This is the configuration file of your website. All of the settings are system wide.

//If enabled, you will recieve all error, warnings, and alerts from PHP, MySQL, and Smarty
$development_mode = true;

//Your database settings 
$database_username = "root";
$database_password = "";
$database_name = "new_application";
$database_host = "localhost";

/*
Having issues with all the functions?
read: https://github.com/MineSQL/MineWORK/blob/master/README.md


 ##################
## User Functions ##
 ##################
#First, create the new class
$users = new user();

### logging in ####
--
$users->checkLogin($db, $username, $password) //Checks login against database, returns an array (message(str), error(bool))
#Note, this also starts the session and completely manages user login.
--
### Registering ###
---
$users->register($db, $information_on_user);
registers a user with previous database function(s)
$information_on_user = array(
			"username" => "Some_Username", //Spaces muck up the script
			"password" => "Some password", 
			"cpassword" => "Some password",
			"email" => "email@email.com",
			"ip" => $_SERVER['REMOTE_ADDR']
			);
#Supply those variables, and the function will do the rest.
---
Creating the inital account database
--
$users->create_user_table($db)
#Make sure you have a database connection and the minesql.database.class.php files it will do the rest
--
*/



//Payment Information 
$paypal_email = "";
$btc_address = "";


//Smarty Debug
// if($development_mode){
// 	$smarty->debugging = true;
// } else {
// 	$smarty->debugging = false;
// }