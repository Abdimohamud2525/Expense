<?php

header('Content-Type: application/json');

// Sisällytetään tietokanta
include '../config/conn.php';

// Käyttäjän rekisteröinti
function userRegistered($conn) {
    // Debug-tulosteet
    error_log("Received POST data: " . print_r($_POST, true));
    error_log("Received FILES data: " . print_r($_FILES, true));

    // Varmistetaan, että POST-tiedot on vastaanotettu oikein
    if (!isset($_POST['username']) || !isset($_POST['password'])) {
        echo json_encode(array("status" => false, "data" => "Username or password not set"));
        return;
    }

    // POST-muuttujien purku
    $username = $_POST['username'];
    $password = md5($_POST['password']); 

    $new_id = generateId($conn); // Muutettu generateId funktioksi
    $data = array();
    $error_array = array();
    $file_name = $_FILES["image"]["name"];
    $file_type = $_FILES["image"]["type"];
    $file_size = $_FILES["image"]["size"];
    $allowedImages = ["image/jpeg", "image/png"]; // Määritä sallitut MIME-tyypit
    $max_size = 5 * 1024 * 1024;
    $save_name = $new_id . ".png"; // Lisää pisteen ja korjaa muuttujan nimi

    if (in_array($file_type, $allowedImages)) {
        if ($file_size > $max_size) {
            $error_array[] = "This file size must be less than " . $max_size . " bytes";
        }
    } else {
        $error_array[] = "This file is not a valid image";
    }

    if (count($error_array) <= 0) {
        // Korjattu INSERT-kysely
        $query = "INSERT INTO `user`(`id`, `username`, `password`, `status`, `image`, `date`) VALUES ('$new_id', '$username', '$password', 'active', '$save_name', NOW())";

        $result = $conn->query($query);
        if ($result) {
            move_uploaded_file($_FILES["image"]["tmp_name"], "../uploads/" . $save_name);
            $data = array("status" => true, "data" => "Successfully registered");
        } else {
            $data = array("status" => false, "data" => "Database error: " . $conn->error);
        }
    } else {
        $data = array("status" => false, "data" => $error_array);
    }

    echo json_encode($data);
}

// Kutsu userRegistered-funktiota
if (isset($_POST['action']) && $_POST['action'] == 'userRegistered') {
    userRegistered($conn);
}

// Käyttäjien listaaminen
function getUserList($conn) {
    $data = array();
    $array_data = array();

    $query = "SELECT `id`, `username`, `status`, `date`,`image` FROM `user`";
    $result = $conn->query($query);
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $array_data[] = $row;
        }
        $data = array("status" => true, "data" => $array_data);
    } else {
        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);
}

// Tunnisteen luonti
function generateId($conn) {
    $new_id = "";
    $query = "SELECT `id` FROM `user` ORDER BY `id` DESC LIMIT 1";
    $result = $conn->query($query);
    if ($result) {
        $num_rows = $result->num_rows;
        if ($num_rows > 0) {
            $row = $result->fetch_assoc();
            $new_id = ++$row["id"];
        } else {
            $new_id = "KTJ01";
        }
    }
    return $new_id;
}

function get_user_info($conn){

    extract($_POST);
    $data = array();
     $query = "SELECT * FROM `user` WHERE id ='$id'";
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

// Päivitä käyttäjän tiedot
function updateUser($conn) {
    extract($_POST);
    $data = array();
    $error_array = array();
    
    if (!isset($username) || !isset($status) || !isset($id)) {
        $error_array[] = "Missing required fields";
    }

    if (count($error_array) <= 0) {
        $query = "UPDATE `user` SET `username`='$username', `status`='$status' WHERE `id`='$id'";

        $result = $conn->query($query);
        if ($result) {
            $data = array("status" => true, "data" => "User updated successfully");
        } else {
            $data = array("status" => false, "data" => $conn->error);
        }
    } else {
        $data = array("status" => false, "data" => $error_array);
    }

    echo json_encode($data);
}

// Poista käyttäjä
function deleteUser($conn) {
    extract($_POST);
    $data = array();

    if (!isset($id)) {
        $data = array("status" => false, "data" => "ID is required");
    } else {
        $query = "DELETE FROM `user` WHERE `id`='$id'";
        $result = $conn->query($query);
        if ($result) {
            $data = array("status" => true, "data" => "User deleted successfully");
        } else {
            $data = array("status" => false, "data" => $conn->error);
        }
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
