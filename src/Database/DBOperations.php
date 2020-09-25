<?php

require_once '../../src/ConfigLoader.php';
require_once '../../src/Log/LogWriter.php';
require_once '../../src/errors.php';


class DBOperations {

    private PDO $conn;
    private LogWriter $log;
    private ConfigLoader $config;

    public function __construct() {
        $this->config = new ConfigLoader;
        $this->log = new LogWriter();
        $this->conn = new PDO(
            "mysql:dbname=".$this->config->get('db.name')."; host=".$this->config->get('db.host'),
            $this->config->get('db.user'),
            $this->config->get('db.pass')
        );
        $this->conn->exec("SET NAMES 'utf-8'");
        $this->conn->exec("SET CHARACTER SET 'utf8'");
    }

    private function error($error): void {
        $this->log->logEntry(__CLASS__, debug_backtrace()[1]['function'], $error);
    }

    public function getHash($password) {
        return password_hash($password."621317", PASSWORD_BCRYPT, ['cost' => 14]);
    }

    public function verifyHash($password, $hash): bool {
        return password_verify($password, $hash);
    }

    public function generateToken($length) {
        $bytes = '';

        try {
            $bytes = random_bytes(ceil($length / 2));
        } catch(Exception $e) {
            $this->error(ERR_INTERNAL);
        }

        return substr(bin2hex($bytes), 0, $length);
    }

    public function generateUniqueToken($length = 10) {
        $sql = 'SELECT COUNT(*) FROM directors WHERE token = :token';

        $query = $this->conn->prepare($sql);
        $query->bindParam(':token', $token);

        $token = $this->generateToken($length);
        $query->execute();


        while ($query->fetchColumn() != 0) {
            $token = $this->generateToken($length);
            $query->execute();
        }

        return $token;
    }

    public function verifyToken($token) {
        $sql = 'SELECT COUNT(*) FROM directors WHERE token = :token';

        $query = $this->conn->prepare($sql);
        $query->execute(
            array(
                ':token' => $token
            )
        );

        return $query->fetchColumn() != 0;
    }

    public function registerDirector($login, $pass, $name, $surname, $id_park) {
        $sql = 'INSERT INTO directors SET login = :login, enc_pass = :enc_pass, name = :name, surname = :surname, id_park = :id_park, token = :token';

        $token = $this->generateUniqueToken();
        $enc_pass = $this->getHash($pass);

        $query = $this->conn->prepare($sql);
        $query->execute(
            array(
                ':login' => $login,
                ':enc_pass' => $enc_pass,
                ':name' => $name,
                ':surname' => $surname,
                ':id_park' => $id_park,
                ':token' => $token
            )
        );

        if (!is_null($query)) {
            return $token;
        }
        return false;
    }

    public function loginDirector($login, $pass) {
        $sql = 'SELECT * FROM directors WHERE login = :login';

        $query = $this->conn->prepare($sql);
        $query->execute(
            array(
                ':login' => $login
            )
        );

        $data = $query->fetchObject();

        if($this->verifyHash($pass."621317", $data->enc_pass)) {
            return $data->token;
        }
    }

    public function getDirector($token) {
        $sql = 'SELECT * FROM directors WHERE token = :token';

        $query = $this->conn->prepare($sql);
        $query->execute(
            array(
                ':token' => $token
            )
        );

        $data = $query->fetchObject();
        $res['name'] = $data->name;
        $res['surname'] = $data->surname;
        $res['id_park'] = $data->id_park;
        return $res;
    }

    public function getPark($token) {
        $sql = 'SELECT * FROM directors WHERE token = :token';

        $query = $this->conn->prepare($sql);
        $query->execute(
            array(
                ':token' => $token
            )
        );

        $director = $query->fetchObject();

        $sql = 'SELECT * FROM parks WHERE id_park = :id_park';

        $query = $this->conn->prepare($sql);
        $query->execute(
            array(
                ':id_park' => $director->id_park
            )
        );

        return $query->fetchObject();

    }
}