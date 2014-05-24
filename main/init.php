<?php
 /**
 * MineSQL - http://MineSQL.me
 * @package PACKAGE-NAME
 */

//Templating Engine
require 'libs/Smarty.class.php';
$smarty = new Smarty;
require 'libs/config.php';
require 'libs/custom/enabled-modules.php';


/*
DATABASE FAQ's
---
How do I use databases? 
->simply use the variable $db to call the PDO object. 
--
Where is the database file?
->The actual connection file is in libs/custom/minesql.database.php 
-->If you want to change your database settings, look in libs/config.php
--
Should I write recurring database actions on a perpage basis?
->No, write it in the database class as a function in libs/custom/minesql.database.class.php then simply
call the function as:
$somevar = new database();
$somevar->yourdbfunction($db, $yourvars)
--
*/

//Misc settings
//$smarty->force_compile = true;
$smarty->debugging = true;
$smarty->caching = true;
$smarty->cache_lifetime = 120;
