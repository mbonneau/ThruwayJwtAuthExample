<?php

class JwtAuthenticationProvider extends Thruway\Authentication\AbstractAuthProviderClient {
    private $jwtKey;

    public function __construct(Array $authRealms, $jwtKey) {
        $this->jwtKey = $jwtKey;
        parent::__construct($authRealms);
    }

    public function getMethodName() {
        return 'jwt';
    }

    public function processAuthenticate($signature, $extra = null)
    {
        $jwt = \Firebase\JWT\JWT::decode($signature, $this->jwtKey, ['HS256']);

        if (isset($jwt->authid)) {
            return ["SUCCESS", ["authid" => $jwt->authid]];
        } else {
            return ["FAILURE"];
        }
    }
}
