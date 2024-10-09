<?php

// asetetaan json sisällä tyypit json

header('content-type: application/json');

// sisälätään tietokanta 

include '../config/conn.php';


// function Registeration 

function Registeration_kulut($conn){

    // sisälätään query

    // shaqadan dhan hal leenkaan hoose ayaa qabtay
    // $amount = $_POST['amount'];
    // $type = $_POST['type'];
    // $description = $_POST['discription'];
    // $userId = $_POST['userId'];

    extract($_POST);
    $data = array();
    $query = "CALL register_expense_sp('','$amount','$type','$description','FIR0002')";


    $result = $conn->query($query);
    if($result){
        $row = $result->fetch_assoc();
        if($row['Message'] == 'Deny'){

            $data = array("status" => false, "data" => "Insufficient balance 😞");
        }
        elseif($row['Message'] == 'Registered'){
            $data = array("status" => true, "data" => "Registered successfully");
        }

    }
    else{
        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);

}


function get_user_transaction($conn){
    extract($_POST);
    $data = array();
   $array_data = array();

    $query = "SELECT `id`, `amount`, `type`, `description` FROM `expence` WHERE 1";
    $result = $conn->query($query);
    if($result){
        while($row = $result->fetch_assoc()){
            $array_data[] = $row;
        }
        $data = array("status" => true , "data" => $array_data);
    }
    else{
        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);

}
function get_user_statment($conn){
    extract($_POST);
   $data = array();
   $array_data = array();

    $query = "CALL get_user_statment_fc('FIR0002', '$from', '$to')";

    $result = $conn->query($query);
    if($result){
        while($row = $result->fetch_assoc()){
            $array_data[] = $row;
        }
        $data = array("status" => true , "data" => $array_data);
    }
    else{
        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);

}

function get_expense_info($conn){

    extract($_POST);
    $data = array();
     $query = "SELECT * FROM `expence` WHERE id ='$id'";
     $result = $conn->query($query);
     if($result){
        $row = $result->fetch_assoc(); 
        $data = array("status" => true , "data" => $row);
     }
     else{
        $data = array("status" => false, "data" => $conn->error);
     }
     echo json_encode($data);
}

function delete_expense_info($conn){
    extract($_POST);
   $data = array();
   $array_data = array();
    $query = "DELETE  FROM `expence` WHERE id = '$id'";
    $result = $conn->query($query);
    if($result){
          $data = array("status" => true , "data" => 'Delete successfully');
    }
    else{
        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);

}




if(isset($_POST['action'])){
    $action = $_POST['action'];

    $action($conn);
}
else{
    echo json_encode(array("status"=> false, "data" => 'action is required'));
}
?>