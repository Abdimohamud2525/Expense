<?php

// asetetaan json sisällä tyypit json

header('content-type: application/json');

// sisälätään tietokanta 

include '../config/conn.php';

function read_all_actions_links(){
    $data = array();
    $data_array = array();

    $search_result = glob("../views/*.php");

    foreach($search_result as $sr){
      $pure_links = explode("/" , $sr);
      $data_array[] = $pure_links[2];
    }

    if(count($search_result) > 0){
        $data = array("status" =>  true, "data" => $data_array);
    }
    else{
        $data = array("status" => false ,  "data" => "there is no data available");
    }

    echo json_encode($data);

}

// function Registeration 

function Registeration_actions($conn){
    extract($_POST);
    $data = array();
    $query = "INSERT INTO `system_actions`(`name`, `system_action`, `link_id`) VALUES('$name', '$system_action', '$link_id')";


    $result = $conn->query($query);
    if($result){
            $data = array("status" => true, "data" => "Register successfully 😎");
        }

    else{
        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);

}


function read_all_db_system($conn){
    extract($_POST);
    $data = array();
   $array_data = array();

    $query = "SELECT * FROM system_actions";
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


function update_system_actions($conn) {
    extract($_POST);
    $data = array();

    // Tarkistetaan, onko id määritelty ja oikean niminen
    if(isset($id) && !empty($id)) {
        $query = "UPDATE system_actions SET name='$name', system_action='$system_action', link_id='$link_id' WHERE id='$id'";

        $result = $conn->query($query);
        if($result) {
            $data = array("status" => true, "data" => "Updated successfully");
        } else {
            $data = array("status" => false, "data" => $conn->error);
        }
    } else {
        $data = array("status" => false, "data" => "Invalid ID");
    }

    echo json_encode($data);
}

function get_actions_info($conn) {
    extract($_POST);
    $data = array();

    // Tarkistetaan, onko id määritelty ja oikean niminen
    if(isset($id) && !empty($id)) {
        $query = "SELECT * FROM `system_actions` WHERE id='$id'";
        $result = $conn->query($query);
        if($result) {
            $row = $result->fetch_assoc();
            $data = array("status" => true, "data" => $row);
        } else {
            $data = array("status" => false, "data" => $conn->error);
        }
    } else {
        $data = array("status" => false, "data" => "Invalid ID");
    }

    echo json_encode($data);
}


function delete_actions_info($conn){
    extract($_POST);
   $data = array();
   $array_data = array();
    $query = "DELETE  FROM `system_actions` WHERE id = '$id'";
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