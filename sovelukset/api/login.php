<?php

session_start();

header('Content-Type: application/json');


// Sisällytetään tietokanta
include '../config/conn.php';

// Käyttäjän rekisteröinti





// Käyttäjien listaaminen
function login($conn) {
    extract($_POST);
    $data = array();
    $array_data = array();

    $query = "CALL login_sp('$username', '$password')";
    $result = $conn->query($query);
    if ($result) {
        $row = $result->fetch_assoc();
      if(isset($row['msg'])){
        if($row['msg'] == 'Deny'){
            $data = array("status" => false, "data" => "Invalid username or password");
        }else{
            $data = array("status" => false, "data" => 'User Locked by tha admin');
        }
      
      }
      else{
        foreach($row as $key => $value){
            $_SESSION[$key] = $value;
        }
        $data = array("status" => true, "data" => 'success login');
      }
       
    } else {
        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);
}


// Käsitellään action-parametri
if (isset($_POST['action'])) {
    $action = $_POST['action'];
    if (function_exists($action)) {
        $action($conn);
    } else {
        echo json_encode(array("status" => false, "data" => "Invalid action"));
    }
} else {
    echo json_encode(array("status"=> false, "data" => 'Action is required'));
}
?>
