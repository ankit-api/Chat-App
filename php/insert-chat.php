<?php
    session_start();
    include_once 'config.php';
    $outgoing_id = mysqli_real_escape_string($conn, $_POST['outgoing_id']);
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    echo $incoming_id;
    if(!empty($message)){
        //let's check email and password will matched with data in database or not
        $sql = mysqli_query($conn, "insert into messages(incoming_msg_id, outgoing_msg_id, msg) values ('$incoming_id', '$outgoing_id' ,'$message')");
    }
    else{
        header("../login.php");
    }
?>