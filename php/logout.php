<?php
    session_start();
    if(isset($_SESSION['unique_id'])){ //if user is logged in then come to this page otherwise go to login page
        include 'config.php';
        $logout_id = mysqli_real_escape_string($conn, $_GET['logout_id']);
        if(isset($logout_id)){ //if logout id is set
            $status = "Offline now";   
            //once user logout then we'll the status to offline and redirect him to login page
            //we'll update the status again to active now if he loggedin successfully
        $sql = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$logout_id}");
            if($sql){
                session_unset();
                session_destroy();
                echo '<script> console.log("logout successfully") </script>';
                header('location: ../login.php');
            }
        } 
        else{
            header('location: ../users.php');
        }
    }
    else{
        header('location: ../login.php');
    }
?>