<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
if (isset($_POST['method'])) {
    switch ($_POST['method']) {
        case 'logIn':
            require '../DB/db.php';
            $db = new DB();
            
            $user['username'] = $_POST['username'];
            $user['pass'] = $_POST['pass'];
            $user = $db->logIn($user);
            $data  = "error";
            $code = 200;
            if ($user != null) {
                session_start();
                $_SESSION['user'] = $user;
                $data = "ok";
            }

            $data  = array('code' => $code,
                'data' => $data,
            );
    
                $response = json_encode($data);
                header('Content-Type: application/json');
                echo $response;

            break;
       
        
        default:
            break;
    }
}
}
?>