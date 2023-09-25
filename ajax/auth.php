<?php
    // ini_set('display_errors', 1);
    // ini_set('display_startup_errors', 1);
    // error_reporting(E_ALL);

    @session_start();
    include $_SERVER['DOCUMENT_ROOT'] . "/inc/db.php";
   

    $response = array('error' => false, 'desc' => '', 'data' => null);

    switch($_POST['action']) {
        
        case 'login': {
            if(!isset($_POST['userEmail']) || empty($_POST['userEmail'])) {
                exit(json_encode(array(
                    'error' => true, 
                    'desc'  => 'Email error', 
                )));
            }

            if(!isset($_POST['userPassword']) || empty($_POST['userPassword'])) {
                exit(json_encode(array(
                    'error' => true, 
                    'desc'  => 'Password error', 
                )));
            }

            $email = $_POST['userEmail'];
            $pass  = md5($_POST['userPassword']);
            
                
            $stmt = $conn->prepare("SELECT * FROM `users` WHERE `email`='$email' AND `password`='$pass'");
            $stmt->execute();

            if($stmt->rowCount() !== 1) {
                exit(json_encode(array(
                    'error' => true, 
                    'desc'  => 'User not found', 
                )));
            }

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            
            $_SESSION['user'] = $result;
        };
        break;

        case 'logout': {
            session_destroy();
        };
        break;

        case 'updateData': {
            $id        = $_POST['id'];
            $firstName = $_POST['firstName'];
            $lastName  = $_POST['lastName'];
            $userEmail = $_POST['userEmail'];
            $mobile    = $_POST['mobile'];

            $stmt = $conn->prepare("UPDATE `users` SET `firstname` = '$firstName' , `lastname` = '$lastName' , `email` = '$userEmail' , `mobile` = '$mobile' WHERE `id` = '$id' ");
            $stmt->execute();

            if($stmt->rowCount() < 0 ) {
                exit(json_encode(array(
                    'error' => true, 
                    'desc'  => 'Query Failed', 
                )));
            }
            else{
                exit(json_encode(array(
                    'error' => false, 
                    'desc'  => 'Data Updated', 
                )));
            }

        };
        break;

        case 'updatePass' : {
            $id        = $_POST['id'];
            $oldPass   = md5($_POST['oldPass']);
            $newPass1  = md5($_POST['newPass1']);
            $newPass2  = md5($_POST['newPass2']);
            
            $stmt = $conn->prepare("SELECT `password` FROM `users` WHERE `id`= '$id' ");
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if($oldPass != $result['password'] ) {
                exit(json_encode(array(
                    'error' => true, 
                    'desc'  => 'Old Password is wrong', 
                )));
            }

            if( $newPass1 != $newPass2 ){
                exit(json_encode(array(
                    'error' => true, 
                    'desc'  => 'The second new password is different from the first', 
                )));
            }
            else{
                $stmt = $conn->prepare("UPDATE `users` SET `password` = '$newPass1'  WHERE `id` = '$id' ");
                $stmt->execute();

                if($stmt->rowCount() < 0 ) {
                    exit(json_encode(array(
                        'error' => true, 
                        'desc'  => 'Query Failed', 
                    )));
                }
                else{
                    exit(json_encode(array(
                        'error' => false, 
                        'desc'  => 'Password Updated', 
                    )));

                }
            }
        }
        break;

        default: {
            $response['error'] = true;
            $response['desc']  = 'Invalid action';
        }

    }




    echo json_encode($response);
?>