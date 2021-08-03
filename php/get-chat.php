<?php
    session_start();
    include_once 'config.php';
    $outgoing_id = mysqli_real_escape_string($conn, $_POST['outgoing_id']);
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    $output = "";
    
    //let's check email and password will matched with data in database or not
    $sql = "select * from messages 
            left  join users on users.unique_id = messages.incoming_msg_id
            where (outgoing_msg_id = {$outgoing_id} and incoming_msg_id = {$incoming_id}) or (outgoing_msg_id = {$incoming_id} and incoming_msg_id = {$outgoing_id}) order by msg_id";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
            if($row['outgoing_msg_id'] === $outgoing_id){ // if it is true then he is the msg sender
                $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>'.$row['msg'].'</p>
                                </div>
                            </div>';
            }
            else{ //he is msg receiver
                $output .= '<div class="chat incoming">
                                <img src="php/images/'. $row['img'] .'" alt="">
                                <div class="details">
                                    <p>'.$row['msg'].'</p>
                                </div>
                            </div>';
            }
        }
        echo $output;
    }
    else{
        header("../login.php");
    }
?>