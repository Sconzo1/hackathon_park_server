<?php

require_once '../../src/Database/DBOperations.php';
require_once '../../src/MBFunctions.php';
require_once '../../src/RPC/JSON_RPC.php';
require_once '../../src/errors.php';
require_once '../../src/Check/regex.php';


class Methods {

    private DBOperations $db;
    private MBFunctions $mb;
    private JSON_RPC $rpc;

    public function __construct() {
        $this->db = new DBOperations();
        $this->mb = new MBFunctions();
        $this->rpc = new JSON_RPC();
    }

    private function error($error) {
        return $this->rpc->makeErrorResponse(__CLASS__, $error, debug_backtrace()[1]['function']);
    }

    public function registerDirector($data)
    {
        $db = $this->db;
        $login = $data->login;
        $pass = $data->pass;
        $name = $data->name;
        $surname = $data->surname;
        $id_park = $data->id_park;

        return $this->rpc->makeResultResponse($db->registerDirector($login, $pass, $name, $surname, $id_park));
    }

    public function loginDirector($data) {
        $db = $this->db;
        $login = $this->mb->mb_trim($data->login);
        $pass = $this->mb->mb_trim($data->pass);

        return  $this->rpc->makeResultResponse($db->loginDirector($login, $pass));
    }

    public function getDirector($data) {
        $db = $this->db;
        $token = $data->token;
        if ($db->verifyToken($token)) {
            return $this->rpc->makeResultResponse($db->getDirector($token));
        }
    }

    public function getPark($data) {
        $db = $this->db;
        $token = $data->token;
        if ($db->verifyToken($token)) {
            return $this->rpc->makeResultResponse($db->getPark($token));
        }
    }


}
