MineWORK
========

  A VERY lightwieght "framework" that uses the SMARTY templating system with custom libraries for generic website tasks such as logging in, creating tables, inserting data, and more tasks that don't need to be recoded time after time.

  This project doesn't aim to try to outshine big frameworks - rather be useful for small or medium sized projects that demand speed, and usability.

  All of the classes and functions are easy to use and get a grasp of. All database interactions are PDO prepared statements (true prepared, not emulated). Passwords are encrypted with the newest security standard, Bcrypt.



Usage
-----

Using this project is very easy. Simply download the files into a new root web directory, and then navigate to the libs/config.php file to edit your configuration settings. They are all explained in the file. If you are having trouble with HTML and this templating engine, refer to smarty's documentation. 


Features
--------


This project comes with many different features and functions. Below are the currently available ones (as of May 24th 2014)

<h4>databasing</h4>
The databasing module handles simple databasing tasks, all in PDO::MySQL You don't have to worry about prepared statements or anything.
Note: The $db variable is the database connection across the whole site.

<h6>Creating a Table (with columns)</h6>
<pre>
<?php
//Loads all the modules and smarty template
require 'init.php';
//The databasing class
$query = new database();

$columns = array(
				'name' => array("type" => "VARCHAR",
					 		  "length" => "(60)" //Encapsulate your number in quotes (functionality with TIMESTAMP)
						     ),
				'value' => array("type" => "INT",
					 		  "length" => "(60) DEFAULT NULL" //Makes the column default value null. Does not break the script. 
						     ),
				 );


$query->table_create($db, "yourtablename", $columns);
</pre>
The $column array is the base of the method. By name, it defines the columns, the datatype, and length (along with any other special arguments you want to pass to that column).

Note: The primary key of the array defines the column name.



<h6>Entering Data Into a Table</h6>

From now on, assume that the database class has been activated under $query
<pre>
<?php
$items = array(
          'name' => 'John Doe',
          'value' => 'healthy'
         );

$query->table_insert($db, "yourtablename", $items);
</pre>
This is a fairly easy function to use. again, basically the same concept as above. Just create an array with the key(s) as the column to insert into, and the (array) value as the value you want to insert.


<h6>Listing out Columns</h6>
The only big use for this is if your expanding upon these functions and you need all the columns of a table to do something.
<pre>
<?php
$response = $query->get_columns($db, "sometable");
echo $response['raw']; //Array of the data
echo $response['text']; //If you need it for development purposes and readablity.
</pre>
This is extremely easy. Lets move onto user management.


<h4>Users & Administrators</h4>
This section creates a standard through out the website of all interactions between the user and database. Authentication, registration, and setting up the inital user table are a couple of the vast functionalities.






