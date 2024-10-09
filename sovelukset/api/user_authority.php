<?php
header('Content-Type: application/json');

include '../config/conn.php';

function read_All_authority_system($conn) {
    $data = array();
    $array_data = array();

    $query = "SELECT * FROM user_authority";
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

function getUserAuhorities($conn) {
    extract($_POST);
    $data = array();
    $array_data = array();

    $query = "CALL get_user_authoritities_sp('$user_id')";
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


function Authorities_users($conn) {
    if (!isset($_POST['user_id']) || !isset($_POST['actions'])) {
        echo json_encode(array("status" => false, "data" => "Required fields are missing"));
        return;
    }

    extract($_POST);
    $user_id = $_POST['user_id'];
    $authority_actions = $_POST['actions'];

    $data = array();
    $success_array = array();
    $error_array = array();

    // Valmisteltu lause SQL-injektion estämiseksi
    $del_stmt = $conn->prepare("DELETE FROM usersauthority WHERE user_id = ?");
    $del_stmt->bind_param('i', $user_id);

    if ($del_stmt->execute()) {
        // Käytetään silmukkaa ja valmisteltuja lauseita turvallisuuden parantamiseksi
        $insert_stmt = $conn->prepare("INSERT INTO usersauthority (user_id, actions) VALUES (?, ?)");

        for ($i = 0; $i < count($authority_actions); $i++) {
            $insert_stmt->bind_param('is', $user_id, $authority_actions[$i]);
            if ($insert_stmt->execute()) {
                $success_array[] = array("status" => true, "data" => 'Successful');
            } else {
                $error_array[] = array("status" => false, "data" => $conn->error);
            }
        }
    } else {
        $error_array[] = array("status" => false, "data" => $conn->error);
    }

    if (count($success_array) > 0 && count($error_array) == 0) {
        $data = array("status" => true, "data" => $success_array);
    } elseif (count($success_array) > 0) {
        $data = array("status" => false, "data" => $error_array);
    } else {
        $data = array("status" => false, "data" => $error_array);
    }

    echo json_encode($data);
}

if (isset($_POST['action'])) {
    $action = $_POST['action'];
    if (function_exists($action)) {
        $action($conn);
    } else {
        echo json_encode(array("status" => false, "data" => 'Invalid action'));
    }
} else {
    echo json_encode(array("status" => false, "data" => 'Action is required'));
}
?>
