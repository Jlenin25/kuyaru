<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require __DIR__.'/classes/Database.php';
require __DIR__.'/classes/JwtHandler.php';

function msg($success,$status,$message,$extra = []){
    return array_merge([
        'success' => $success,
        'status' => $status,
        'message' => $message
    ],$extra);
}

$db_connection = new Database();
$conn = $db_connection->dbConnection();

$data = json_decode(file_get_contents("php://input"));
$returnData = [];

// Si el método de solicitud no es igual a la publicación
if($_SERVER["REQUEST_METHOD"] != "POST"):
    $returnData = msg(0,404,'Página no encontrada');

// Comprobación de campos vacíos
elseif(!isset($data->user_email) 
    || !isset($data->password)
    || empty(trim($data->user_email))
    || empty(trim($data->password))
    ):

    $fields = ['fields' => ['user_email','password']];
    $returnData = msg(0,422,'Por favor llena los campos requeridos',$fields);

// Si no existe campos vaciós entonces:
else:
    $user_email = trim($data->user_email);
    $password = trim($data->password);

    // Comprobación del formato del correo electrónico (SI EL FORMATO NO ES VÁLIDO)
    if(!filter_var($user_email, FILTER_VALIDATE_EMAIL)):
        $returnData = msg(0,422,'Correo electrónico no válido');
    
    // Si la contraseña es menor de 8 caracteres, muestra el error
    elseif(strlen($password) < 8):
        $returnData = msg(0,422,'Contraseña incorrecta');

    // El usuario puede realizar la acción de INICIAR SESIÓN
    else:
        try{
            $fetch_user_by_email = "SELECT * FROM `usuarios` WHERE `user_email`=:user_email";
            $query_stmt = $conn->prepare($fetch_user_by_email);
            $query_stmt->bindValue(':user_email', $user_email,PDO::PARAM_STR);
            $query_stmt->execute();

            // Si el usuario es encontrado por NOMBRE DE USUARIO
            if($query_stmt->rowCount()):
                $row = $query_stmt->fetch(PDO::FETCH_ASSOC);
                $check_password = password_verify($password, $row['password']);

                // Verificación de la contraseña (ES CORRECTA: SI o NO)
                // Si la contraseña es correcta, envía el Token de INICIO DE SESIÓN
                if($check_password):

                    $jwt = new JwtHandler();
                    $token = $jwt->jwtEncodeData(
                        'http://localhost/kuyaru/config/',
                        array("user_id"=> $row['user_id'])
                    );
                    $returnData = [
                        'success' => 1,
                        'message' => 'Has iniciado sesión correctamente',
                        'token' => $token
                    ];

                // IF INVALID PASSWORD
                else:
                    $returnData = msg(0,422,'Contraseña incorrecta');
                endif;

            // Si no se encuentra el NOMBRE DE USUARIO se muestra el siguiente error
            else:
                $returnData = msg(0,422,'Correo electrónico no válido');
            endif;
        }
        catch(PDOException $e){
            $returnData = msg(0,500,$e->getMessage());
        }

    endif;

endif;

echo json_encode($returnData);