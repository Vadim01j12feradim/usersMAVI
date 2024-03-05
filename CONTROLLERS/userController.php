<?php
require '../dashboard/sessionValidation.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
if (isset($_POST['method'])) {
    require '../DB/db.php';
    $db = new DB();
    switch ($_POST['method']) {
        case 'addUser':
            
            $user['name'] = $_POST['name'];
            $user['apellido'] = $_POST['apellido'];
            $user['domicilio'] = $_POST['domicilio'];
            $user['correo'] = $_POST['correo'];
            $data = $db->insertUser($user);
            $code = 200;
            $data  = array('code' => $code,
                'data' => $data,
            );
    
            $response = json_encode($data);
            header('Content-Type: application/json');
            echo $response;
            break;

            break;

        case 'updateUser':
           
            $code = 200;
            try{
                $user['id'] = $_POST['id'];
                $user['name'] = $_POST['name'];
                $user['apellido'] = $_POST['apellido'];
                $user['domicilio'] = $_POST['domicilio'];
                $user['correo'] = $_POST['correo'];

                $data = $db->updateUser($user);
                }catch(Exception $e){
                    $code  = 500;
                }
                
                $data  = array('code' => $code,
                'sms' => $data);
    
                $response = json_encode($data);
                header('Content-Type: application/json');
                echo $response;
                break;

        case 'getUsers':
           
            $code = 200;
            try{
                $data = $db->getUsers();
            }catch(Exception $e){
                $code  = 500;
            }
            
            $data  = array('code' => $code,
                            'data' => $data);

            $response = json_encode($data);
            header('Content-Type: application/json');
            echo $response;
            break;
        case 'desactive':

            $code = 200;
            try{
                $user['id'] = $_POST['id'];
                $db->desactive($user);
            }catch(Exception $e){
                $code  = 500;
            }
            
            $data  = array('code' => $code);

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