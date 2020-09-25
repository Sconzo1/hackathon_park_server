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


}