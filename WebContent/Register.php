<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include ("db-connection.php");
/* @var $_POST type */
$Username= filter_input(INPUT_POST, "name");
$password= filter_input(INPUT_POST,"password");
$email= filter_input(INPUT_POST,"email");

try
{
    $query = "SELECT username FROM todoappdb WHERE username='".$username."'";
    mysql_select_db('dbname');

   $result=mysql_query($query);

   if (mysql_num_rows($query) != 0)
   {
     echo "Username already exists";
   }
    else
    {
        $stmt = $db->prepare("INSERT INTO todoappdb values(:name, :pass,:email");
        $stmt->execute(array(':name' => $name, ':pass'=>$pass,':email'=>email ));
    }  

    }
catch (Exception $e){
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

