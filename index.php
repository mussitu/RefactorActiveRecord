<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
      
require_once "dbConn.php";
require_once "collection.php";
require_once "accounts.php";
require_once "todos.php";
require_once "model.php";
require_once "account.php";
require_once "todo.php";

/*
define(WEBROOT, dirname(__FILE__) . '/');

spl_autoload_register(function ($class_name) {
    $className=str_replace("\\","/",$class_name);
    $class= WEBROOT . '' ."{$className}.php";
    include $class;
});
 * 
 */

//turn on debugging messages
ini_set('display_errors', 'On');
error_reporting(E_ALL);

define('USELOCALSERVER', TRUE);

define('DATABASE', 'mt444');
define('USERNAME', 'mt444');
define('PASSWORD', 'ug1Ts82iV');

if (USELOCALSERVER) {
    define('CONNECTION', 'localhost');
} else {
    define('CONNECTION', 'sql2.njit.edu');
}

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
            table, th, td {
            border: 1px solid black;
            }
        </style>
    </head>
    <body>
        <?php
        // this would be the method to put in the index page for accounts
        echo '<h1>Find All Account Records</h1>';

        $records = accounts::findAll();
        echo account::format_to_html($records);
        echo '<br>';

        echo '<h1>Find All ToDo Records</h1>';
        // this would be the method to put in the index page for todos
        $records = todos::findAll();
        echo todo::format_to_html($records);

        // print_r($records);

        echo '<h1>Find ToDo Record with ID 1</h1>';
        //this code is used to get one record and is used for showing one record or updating one record
        $record = todos::findOne(1);
        echo todo::format_to_html($record);
        //print_r($record);

        echo '<h1>Insert New ToDo Record</h1>';
        $record = todos::insertOne(array('owneremail' => 'hera@greece.gov',
                               'ownerid' => 1,
                               'createddate' => "20171010",
                               'duedate' => "20171010",
                               'message' => 'Do something about Aphrodite.',
                               'isdone' => 0));
        echo '<h1>Find All ToDo Records After Inserting</h1>';
        // this would be the method to put in the index page for todos
        $records = todos::findAll();
        echo todo::format_to_html($records);

        $lastInTable = end($records);

        echo "<h1>Delete Record With ID $lastInTable->id</h1>";

        todos::deleteOne($lastInTable->id);

        echo '<h1>Find All ToDo Records After Deleting</h1>';
        // this would be the method to put in the index page for todos
        $records = todos::findAll();
        echo todo::format_to_html($records);

        $records = todos::findAll();
        $lastInTable = end($records);
        echo "<h1>Update Record With ID $lastInTable->id</h1>";
        todos::updateOne($lastInTable->id, array('owneremail' => 'random@person.earth'));

        echo '<h1>Find All ToDo Records After Updating</h1>';
        // this would be the method to put in the index page for todos
        $records = todos::findAll();
        echo todo::format_to_html($records);
        ?>
    </body>
</html>
