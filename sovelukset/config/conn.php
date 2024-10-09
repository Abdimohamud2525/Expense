<?php

$conn = new mysqli("localhost", "root", "", "expense");

if($conn->connect_error){

    echo $connect_error;
}

?>