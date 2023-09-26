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
            if (!filter_var($_POST['userEmail'], FILTER_VALIDATE_EMAIL)){
                exit(json_encode(array(
                    'error' => true, 
                    'desc'  => 'Email form not valid', 
                )));
            }

            $email = $_POST['userEmail'];
            $pass  = hash('sha256' , $_POST['userPassword']); 
            
                
            $stmt = $conn->prepare("SELECT * FROM `users` WHERE `email`= ? AND `password`= ? ");
            $stmt->bindParam(1, $email, PDO::PARAM_STR);
            $stmt->bindParam(2, $pass, PDO::PARAM_STR);
            $stmt->execute();

            if($stmt->rowCount() !== 1) {
                exit(json_encode(array(
                    'error' => true, 
                    'desc'  => 'User not found', 
                )));
            }

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if(isset($_POST['rememberMe']) && $_POST['rememberMe'] == 'true'){
                $text = uniqid(); 
                $token = hash('sha256', $text);
                setcookie('token', $token, time()+60*60*24*30*12*100 , '/');
                $stmt = $conn->prepare("UPDATE `users` SET `token` = '$token' WHERE `email` = '$email' ");
                $stmt->execute();
            }
            
            
            $_SESSION['user'] = $result;
        };
        break;

        case 'logout': {
            session_destroy();
            setcookie('token', "", time() - 3600, '/');
        };
        break;

        case 'updateData': {
            $id        = $_POST['id'];
            $firstName = $_POST['firstName'];
            $lastName  = $_POST['lastName'];
            $userEmail = $_POST['userEmail'];
            $mobile    = $_POST['mobile'];
            if(empty($userEmail)){
                exit(json_encode(array(
                    'error' => true, 
                    'desc'  => 'Email cannot be empty', 
                )));
            }
            if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)){
                exit(json_encode(array(
                    'error' => true, 
                    'desc'  => 'Email form not valid', 
                )));
            }
            $stmt = $conn->prepare("SELECT * FROM `users` WHERE `email` = '$userEmail' AND `id` != '$id' ");
            $stmt->execute();
            if($stmt->rowCount() > 0 ) {
                exit(json_encode(array(
                    'error' => true, 
                    'desc'  => 'Email already exists', 
                )));
            }

            $stmt = $conn->prepare("UPDATE `users` SET `firstname` = '$firstName' , `lastname` = '$lastName' , `email` = '$userEmail' , `mobile` = '$mobile' WHERE `id` = '$id' ");
            $stmt->execute();

            if($stmt->rowCount() < 0 ) {
                exit(json_encode(array(
                    'error' => true, 
                    'desc'  => 'Query Failed', 
                )));
            }
            else{
                $_SESSION['user']['firstname'] = $firstName;
                $_SESSION['user']['lastname']  = $lastName;
                $_SESSION['user']['email']     = $userEmail;
                $_SESSION['user']['mobile']    = $mobile;
                exit(json_encode(array(
                    'error' => false, 
                    'desc'  => 'Data Updated', 
                )));
            }

        };
        break;

        case 'updatePass' : {
            $id        = $_POST['id'];
            $oldPass   = hash('sha256',$_POST['oldPass']);
            $newPass1  = hash('sha256',$_POST['newPass1']);
            $newPass2  = hash('sha256',$_POST['newPass2']);
            
            $stmt = $conn->prepare("SELECT `password` FROM `users` WHERE `id`= '$id' ");
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if($oldPass != $result['password'] ) {
                exit(json_encode(array(
                    'error' => true, 
                    'desc'  => 'Old Password is wrong', 
                )));
            }
            else if( $newPass1 != $newPass2 ){
                exit(json_encode(array(
                    'error' => true, 
                    'desc'  => 'The second new password is different from the first', 
                )));
            }
            else if( empty($_POST['newPass1']) ){
                exit(json_encode(array(
                    'error' => true, 
                    'desc'  => 'Password cannot be empty', 
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