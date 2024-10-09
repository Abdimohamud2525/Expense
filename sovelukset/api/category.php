<?php

// asetetaan json sisällä tyypit json

header('content-type: application/json');

// sisälätään tietokanta 

include '../config/conn.php';


// function Registeration 

function Registeration_category($conn){

    // sisälätään query

    // shaqadan dhan hal leenkaan hoose ayaa qabtay
    // $amount = $_POST['amount'];
    // $type = $_POST['type'];
    // $description = $_POST['discription'];
    // $userId = $_POST['userId'];

    extract($_POST);
    $data = array();
    $query = "INSERT INTO `category`(`name`, `icon`, `role`) VALUES('$name', '$icon', '$role')";


    $result = $conn->query($query);
    if($result){
            $data = array("status" => true, "data" => "Register successfully 😞");
        }
    
    else{
        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);

}


function read_all_gategory($conn){
    extract($_POST);
    $data = array();
   $array_data = array();

    $query = "SELECT * FROM category";
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

function update_category($conn) {
    extract($_POST);
    $data = array();
    $query = "UPDATE category SET name='$name', icon='$icon', role='$role'";

    $result = $conn->query($query);
    if($result){
        $data = array("status" => true, "data" => "Updated successfully");
    } else {
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

function get_category_info($conn){

    extract($_POST);
    $data = array();
     $query = "SELECT * FROM category WHERE id ='$id'";
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

function delete_category_info($conn){
    extract($_POST);
   $data = array();
   $array_data = array();
    $query = "DELETE  FROM `category` WHERE id = '$id'";
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