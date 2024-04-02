<?php

namespace App\Models;

use PDO;
use PDOException;

class BaseModel
{
    protected $conn;
    protected $tableName;
    protected $primaryKey = "id";
    protected $sqlBuilder;
    public function __construct()
    {
        $host = HOST;
        $userName = USERNAME;
        $password = PASSWORD;
        $dbName = DBNAME;
        try {
            $this->conn = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8", $userName, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error SQL:" . $e->getMessage();
        }
    }
    public static function all()
    {
        $model = new static;
        $model->sqlBuilder = "SELECT * FROM $model->tableName";
        $stmt = $model->conn->prepare($model->sqlBuilder);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS);
        return $result;
    }
    // @param $id;
    public static function find($id)
    {
        $model = new static;
        $model->sqlBuilder = "SELECT * FROM $model->tableName WHERE $model->primaryKey = :id";
        $stmt = $model->conn->prepare($model->sqlBuilder);
        $data = ["id" => $id];
        $stmt->execute($data);
        $result = $stmt->fetchAll(PDO::FETCH_CLASS);
        if ($result) {
            return $result[0];
        }
        return $result;
    }

    public static function insert($data)
    {
        $model = new static;
        $columnNames = "";
        $paramName = "";
        foreach ($data as $key => $value) {
            $columnNames .= "`$key`, ";
            $paramName .= ":$key, ";
        }
        $columnNames = rtrim($columnNames, ", ");
        $paramName = rtrim($paramName, ", ");
        $model->sqlBuilder = "INSERT INTO $model->tableName ($columnNames) VALUES ($paramName)";

        $stmt = $model->conn->prepare($model->sqlBuilder);
        $stmt->execute(($data));
        //trả lại giá trị khóa vừa thêm
        return $model->conn->lastInsertId();
    }

    //update product
    public static function update($id, $data)
    {
        $model = new static;
        $model->sqlBuilder = "UPDATE $model->tableName SET ";
        foreach ($data as $key) {
            $model->sqlBuilder .= "`$key`=:$key, ";
        }
        $model->sqlBuilder = rtrim($model->sqlBuilder, ", ");
        $model->sqlBuilder .= " WHERE $model->primaryKey=:$model->primaryKey";
        $data["$model->primaryKey"] = $id;
        $stmt=$model->conn->prepare($model->sqlBuilder);
        $stmt->execute($data);
    }
    //delete 
    public static function delete($id){
        $model=new static;
        $model->sqlBuilder = "DELETE FROM $model->tableName WHERE $model->primaryKey=:$model->primaryKey";
        $stmt=$model->conn->prepare($model->sqlBuilder);
        $stmt->bindParam(":$model->primaryKey",$id);
        $stmt->execute();
    }
    //where lấy nhều điều kiện
    public static function where ($column,$codition,$value){
        $model=new static;
        $model->sqlBuilder ="SELECT * FROM $model->tableName WHERE `$column` $codition '$value'";
        return $model;
    }
    //AndWHere
    public function andWhere($column,$codition,$value){
        $this->sqlBuilder.= "AND `$column` $codition '$value'";
        return $this;
    }

    public function orWhere($column,$codition,$value){
        $this->sqlBuilder.="OR `$column` $codition 'value'";
        return $this;
    }

    public function get(){
        $stmt = $this->conn->prepare($this->sqlBuilder);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS);
        return $result;
    }
}
