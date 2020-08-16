<?php

namespace Trainingskalender\models;

abstract class BaseModel
{

    const TYPE_INT = 'int';
    const TYPE_STRING = 'string';
    const TYPE_FLOAT = 'float';
    const TYPE_ENUM_G = 'enum';
    protected $data = [];
    protected $schema = [];


    public function __construct($params)
    {
        foreach ($this->schema as $key => $value) {

            if (isset($params[$key])) {
                $this->data[$key] = $params[$key];
            } else {
                $this->data[$key] = null;
            }

        }

    }


    public static function tableName()
    {
        $class = get_called_class();
        if (defined($class . '::TABLENAME')) {
            return $class::TABLENAME;

        }
        return null;
    }

    public static function find($where = '')
    {
        $db = $GLOBALS['db'];
        $result = null;

        try {

            $sql = 'SELECT * FROM ' . self::tableName();
            if (!empty($where)) {
                $sql .= ' WHERE ' . $where . ';';
            }
            $statement = $db->prepare($sql);
            $statement->execute();
            $result = $statement->fetchall();

        } catch (\PDOException $e) {
            die('select statement failed: ' . $e . getMessage());
        }
        $db=null;
        return $result;

    }
    public static function findComplex($join, $where, $orderBy, $groupByAndHaving, $limitAndOffset=null)
    {
        $db = $GLOBALS['db'];
        $result = null;

        try {

            $sql = 'SELECT * FROM ' . self::tableName(). '  ';
            if (!empty($join)) {
                $sql .= $join .' ';
            }
            if (!empty($where)) {
                $sql .= $where . ' ';
            }
            if (!empty($orderBy)) {
                $sql .=$orderBy . ' ';
            }
            if (!empty($groupByAndHaving)) {
                $sql .= $groupByAndHaving . ' ';
            }
            if (!empty($limitAndOffset)) {
                $sql .=$limitAndOffset . ' ';
            }
            $statement = $db->prepare($sql);
            $statement->execute();
            $result = $statement->fetchall();

        } catch (\PDOException $e) {
            die('select statement failed: ' . $e . getMessage());
        }
        $db=null;
        return $result;

    }

    public function __get($key)
    {
        if (array_key_exists($key, $this->data)) {
            return $this->data[$key];
        }
        throw new \Exception('You can not access the property "' . $key . '" of the class ' . get_called_class());
    }

    public function __set($key, $value)
    {
        if (array_key_exists($key, $this->schema)) {
            $this->data[$key] = $value;
        } else {
            throw new \Exception('You can not access the property "' . $key . '" of the class ' . get_called_class());
        }
    }

    public function save(&$errors = null)
    {
        if ($this->id === null) {
            $this->insert($errors);
        } else {
            $this->update($errors);
        }
    }

    protected function insert(&$errors)
    {
        $db = $GLOBALS['db'];
        try {
            $sql = 'insert into ' . self::tableName() . '(';
            $valueString = 'values (';

            foreach ($this->schema as $key => $schemaOption) {
                $sql .= $key . ',';
                if ($this->data[$key] === null) {
                    $valueString .= 'NULL,';
                } else {
                    $valueString .= $db->quote($this->data[$key]) . ',';
                }
            }
            $sql = trim($sql, ',');
            $valueString = trim($valueString, ',');
            $sql .= ') ';
            $valueString .= '); ';
            $sql .= $valueString;
            $statement = $db->prepare($sql);

            if ($statement->execute()) {
                $this->data['id'] = $db->lastInsertId();
            }
            $db=null;
            return true;
        } catch (\PDOException $e) {
            $errors[] = 'Error inserting ' . ' in' . get_called_class() . ':' . $e->getMessage();
        }
        return false;
    }

    protected function update(&$errors)
    {
        $db = $GLOBALS['db'];
        try {
            $sql = 'update ' . self::tableName() . ' set ';
            foreach ($this->schema as $key => $schemaOption) {
                if ($this->data[$key] === null) {
                    $sql .= $key . ' = null,';
                } else {
                    $sql .= $key . ' = ' . $db->quote($this->data[$key]) . ',';
                }
            }
            $sql = trim($sql, ',');
            $sql .= ' where id= ' . $this->data['id'];
            $statement = $db->prepare($sql);
            $statement->execute();
        } catch (\PDOException $e) {
            $errors[] = 'Error updating ' . ' in' . get_called_class() . ': $e->getMessage()';
        }
        $db=null;
    }

    public function delete(&$errors)
    {
        try {
            $db = $GLOBALS['db'];
            $sql = 'delete from ' . self::tableName() . ' where id= ' . $this->id;
            $statement = $db->prepare($sql);

            $statement->execute();

        } catch (\PDOException $e) {
            $errors[] = 'Error deleting ' . ' in' . get_called_class() . ': $e->getMessage()';
        }
        $db=null;
    }

    protected function validateValue($attribute, &$value, &$schemaOptions)
    {

        $type = $schemaOptions['type'];
        switch ($type) {
            case self::TYPE_FLOAT:
                break;
            case self::TYPE_INT:
                break;
            case self::TYPE_STRING:
                if (isset($schemaOptions['min']) && mb_strlen($value) < $schemaOptions['min']) {
                    return $attribute . ' : String needs min ' . $schemaOptions['min'] . ' characters';
                }
                if (isset($schemaOptions['max']) && mb_strlen($value) > $schemaOptions['max']) {
                    return $attribute . ' : String can have max ' . $schemaOptions['max'] . ' characters';
                }
                break;

        }
        return true;
    }

    public function validate(&$errors = null)
    {

        foreach ($this->schema as $key => $schemaOptions) {
            if (isset($this->data[$key]) && is_array($schemaOptions)) {
                $valueErrors = $this->validateValue($key, $this->data[$key], $schemaOptions);
                if ($valueErrors !== true) {
                    array_push($errors, $valueErrors);
                }
            }
        }
        if (count($errors) === 0) {
            return true;
        } else {
            return false;
        }
    }

}