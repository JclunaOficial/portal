<?php
if(!defined('ROOT_DIR')) { die('Acceso Denegado'); }

class Model {

    private $data_model;

    public function query($query, $params = null) {
        $model = $this->getDataModel();
        $statement = $model->prepare($query);
        if ($params != null && count($params) > 0) {
            $statement->execute($params);
        } else {
            $statement->execute();
        }

        $result = $statement->fetchAll();
        if ($result === false) {
            $this->throwModelError($model->errorInfo());
        }
        return $result;
    }

    public function execute($query, $params = null) {
        $model = $this->getDataModel();
        $statement = $model->prepare($query);
        if ($params != null && count($params) > 0) {
            $result = $statement->execute($params);
        } else {
            $result = $statement->execute();
        }

        if (!$result) {
            $this->throwModelError($model->errorInfo());
        }
        return $statement->rowCount();
    }

    public function scalar($query, $params = null) {
        $model = $this->getDataModel();
        $statement = $model->prepare($query);
        if ($params != null && count($params) > 0) {
            $result = $statement->execute($params);
        } else {
            $result = $statement->execute();
        }

        if (!$result) {
            $this->throwModelError($model->errorInfo());
        }
        return $statement->fetchColumn();
    }

    public function insert($query, $params = null) {
        $affected = $this->execute($query, $params);
        if ($affected) {
            return $this->getDataModel()->lastInsertId();
        } else {
            return 0;
        }
    }

    public function __destruct() {
        $this->data_model = null;
    }

    public static function getData($data, $key, $default = null) {
        if (array_key_exists($key, $data)) {
            return $data[$key];
        } else {
            return $default;
        }
    }

    public static function getDataString($data, $key, $default = '') {
        return self::getData($data, $key, $default);
    }

    public static function getDataInteger($data, $key, $default = 0) {
        return intval(self::getData($data, $key, $default));
    }

    public static function getDataFloat($data, $key, $default = 0.0) {
        return floatval(self::getData($data, $key, $default));
    }

    public static function getDataBoolean($data, $key, $default = false) {
        return boolval(self::getData($data, $key, $default));
    }

    private function getDataModel() {
        if ($this->data_model !== null) {
            return $this->data_model;
        }

        try {
            $dm = new PDO(DB_DSN, DB_USR, DB_PWD);
            $dm->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->data_model = $dm;
            return $this->data_model;
        } catch (Exception $exc) {
            throw new Exception('Model Error: ' . $exc->getMessage());
        }
    }

    private function throwModelError(array $info) {
        throw new Exception('Model Error [' . $info[0] . ', ' . $info[1] . '] ' . $info[2]);
    }

}
