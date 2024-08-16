<?php

if(isset($_GET['id'])){
    $id=$_GET["id"];

    $serverName="localhost";
    $userName="root";
    $password="";
    $dataBase="myshop";

//Create Connection
$connection=new mysqli( $serverName , $userName , $password , $dataBase );
$sql="DELETE FROM clients WHERE id =$id ";
$result=$connection->query($sql);

}

header("location:/myshop/index.php");
exit;

?>