<?php

require_once("../db_config.php");

if(isset($_GET["id"])){
    $id=$_GET["id"];
    $price_rs=$db->query("select name,phone,email,address from {$ex}publishers_details where publishers_id=$id");
    $row=$price_rs->fetch_object();

    echo "Name : ".$row->name."<br>";
    echo "Phone : ".$row->phone."<br>";
    echo "Email : ".$row->email."<br>";
    echo "Address : ".$row->address."<br>";
    die();
}
echo "0"
?>