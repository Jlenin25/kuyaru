<?php

require './vendor/autoload.php';
use Firebase\JWT\JWT;

class JwtHandler {
    protected $jwt_secrect;
    protected $token;
    protected $issuedAt;
    protected $expire;
    protected $jwt;

    public function __construct() {
        // Establece tu zona horaria predeterminada
        date_default_timezone_set('America/Lima');
        $this->issuedAt = time();
        // Validez del token (3600 segundos = 1 hora)
        $this->expire = $this->issuedAt + 3600;
        // Establece tu secreto o firma
        $this->jwt_secrect = "this_is_my_secrect";
    }

    public function jwtEncodeData($iss, $data) {
        $this->token = array(
            // Agregar el identificador al token (quién emite el token)
            "iss" => $iss,
            "aud" => $iss,
            // Agregar la marca de tiempo actual al token, para identificar cuándo se emitió el token.
            "iat" => $this->issuedAt,
            // Caducidad del token
            "exp" => $this->expire,
            // Carga útil
            "data" => $data
        );
        $this->jwt = JWT::encode($this->token, $this->jwt_secrect, 'HS256');
        return $this->jwt;
    }

    public function jwtDecodeData($jwt_token) {
        try {
            $decode = JWT::decode($jwt_token, $this->jwt_secrect, array('HS256'));
            return [
                "data" => $decode->data
            ];
        } catch (Exception $e) {
            return [
                "message" => $e->getMessage()
            ];
        }
    }
}