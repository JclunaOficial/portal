<?php

// prevenir el acceso directo
if (!defined('ROOT_DIR')) {
    die('Usted no puede cargar esta pagina directamente.');
}

/**
 * Componente MVC Model para la persistencia de datos
 */
class Model {

    // variables de trabajo
    private $data_model;

    /**
     * Ejecutar sentencia SQL para recuperar un conjunto de datos
     * @param string $query instrucción T-SQL a ejecutar
     * @param array $params lista de valores para los parametros del query
     * @return array conjunto de registros afectados
     */
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

    /**
     * Ejecutar sentencia SQL y recuperar el número de registros afectados
     * @param string $query instrucción T-SQL a ejecutar
     * @param array $params lista de valores para los parametros del query
     * @return int número de registros afectados
     */
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

    /**
     * Ejecutar sentencia SQL y recuperar un solo valor
     * @param string $query instrucción T-SQL a ejecutar
     * @param array $params lista de valores para los parametros del query
     * @return mixed valor de la primer columna del primer renglon
     */
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

    /**
     * Ejecutar sentencia SQL para insertar y recuperar el último ID
     * @param string $query instrucción T-SQL a ejecutar
     * @param array $params lista de valores para los parametros del query
     * @return int ID del último registro insertado
     */
    public function insert($query, $params = null) {
        $affected = $this->execute($query, $params);
        if ($affected) {
            return $this->getDataModel()->lastInsertId();
        } else {
            return 0;
        }
    }

    /**
     * Cerrar la conexión y liberar los recursos utilizados
     */
    public function __destruct() {
        $this->data_model = null;
    }

    /**
     * Buscar y recuperar el valor de un campo
     * @param array $data conjunto de datos
     * @param string $fieldName nombre del campo a localizar
     * @param mixed $defaultValue valor por defecto si no existe el campo
     * @return mixed valor localizado
     */
    public static function getData($data, $fieldName, $defaultValue = null) {
        if (array_key_exists($fieldName, $data)) {
            return $data[$fieldName];
        } else {
            return $defaultValue;
        }
    }

    /**
     * Buscar y recuperar el valor string de un campo
     * @param array $data conjunto de datos
     * @param string $fieldName nombre del campo a localizar
     * @param string $defaultValue valor por defecto si no existe el campo
     * @return string valor localizado
     */
    public static function getDataString($data, $fieldName, $defaultValue = '') {
        return self::getData($data, $fieldName, $defaultValue);
    }

    /**
     * Buscar y recuperar el valor entero de un campo
     * @param array $data conjunto de datos
     * @param string $fieldName nombre del campo a localizar
     * @param int $defaultValue valor por defecto si no existe el campo
     * @return int valor localizado
     */
    public static function getDataInteger($data, $fieldName, $defaultValue = 0) {
        return intval(self::getData($data, $fieldName, $defaultValue));
    }

    /**
     * Buscar y recuperar el valor flotante de un campo
     * @param array $data conjunto de datos
     * @param string $fieldName nombre del campo a localizar
     * @param float $defaultValue valor por defecto si no existe el campo
     * @return float valor localizado
     */
    public static function getDataFloat($data, $fieldName, $defaultValue = 0.0) {
        return floatval(self::getData($data, $fieldName, $defaultValue));
    }

    /**
     * Buscar y recuperar el valor boleano de un campo
     * @param array $data conjunto de datos
     * @param string $fieldName nombre del campo a localizar
     * @param boolean $defaultValue valor por defecto si no existe el campo
     * @return boolean valor localizado
     */
    public static function getDataBoolean($data, $fieldName, $defaultValue = false) {
        return boolval(self::getData($data, $fieldName, $defaultValue));
    }

    /**
     * Buscar y recuperar el valor de fecha de un campo
     * @param array $data conjunto de datos
     * @param string $fieldName nombre del campo a localizar
     * @param DateTime $defaultValue valor por defecto si no existe el campo
     * @return DateTime valor localizado
     */
    public static function getDataDate($data, $fieldName, $defaultValue = null) {
        return new DateTime(self::getData($data, $fieldName, $defaultValue));
    }

    // establecer la conexión al modelo de datos
    private function getDataModel() {
        if ($this->data_model !== null) {
            // reutilizar la instancia existente (cache)
            return $this->data_model;
        }

        try {
            // establecer la conexión
            $dm = new PDO(DB_DSN, DB_USR, DB_PWD);
            $dm->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // asignar la instancia (cache)
            $this->data_model = $dm;
            return $this->data_model;
        } catch (Exception $exc) {
            throw new Exception('Model Error: ' . $exc->getMessage());
        }
    }

    // disparar la excepción administrada
    private function throwModelError(array $info) {
        throw new Exception('Model Error [' . $info[0] . ', ' . $info[1] . '] ' . $info[2]);
    }

}
