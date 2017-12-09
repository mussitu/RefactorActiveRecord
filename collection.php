<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class collection {
    static public function create() {
      $model = new static::$modelName;

      return $model;
    }

    static public function findAll() {

        $db = dbConn::getConnection();
        $tableName = get_called_class();
        $sql = 'SELECT * FROM ' . $tableName;
        $statement = $db->prepare($sql);
        $statement->execute();
        echo static::$modelName;
        $class = static::$modelName;
        $statement->setFetchMode(\PDO::FETCH_CLASS, $class);
        $recordsSet =  $statement->fetchAll();
        return $recordsSet;
    }

    static public function findOne($id) {

        $db = dbConn::getConnection();
        $tableName = get_called_class();
        $sql = 'SELECT * FROM ' . $tableName . ' WHERE id =' . $id;
        $statement = $db->prepare($sql);
        $statement->execute();
        echo static::$modelName;
        $class = static::$modelName;
        $statement->setFetchMode(\PDO::FETCH_CLASS, $class);
        $recordsSet =  $statement->fetchAll();
        return $recordsSet[0];
    }
    
    static public function insertOne($keyValuePairArray) {
        $db = dbConn::getConnection();
        $tableName = get_called_class();
        $sql = 'INSERT INTO ' . $tableName;
        $columnNames = '(';
        $values = '(';
        $firstIteration = TRUE;
        foreach ($keyValuePairArray as $key => $value) {
            if (! $firstIteration) {
                $columnNames .= ', ';
                $values .= ', ';
            } else {
                $firstIteration = FALSE;
            }
            
            $columnNames .= $key;
            
            if ($key == 'isdone') {
                $values .= $value;
            } else {
                $values .= "'$value'";
            }
        }
        
        $columnNames .= ')';
        $values .= ')';
        
        $sql .= ' ' . $columnNames . ' VALUES ' . $values;
        
        $statement = $db->prepare($sql);
        $statement->execute();
    }
    
    static public function updateOne($id, $keyValuePairs) {
        $db = dbConn::getConnection();
        $tableName = get_called_class();
        $sql = 'UPDATE ' . $tableName . " SET";
        $firstIteration = TRUE;
        foreach ($keyValuePairs as $key => $value) {
            if (! $firstIteration) {
                $sql .= ', ';
            } else {
                $firstIteration = FALSE;
                $sql .= ' ';
            }
            
            if ($key == 'isdone') {
                $sql .= "$key = $value";
            } else {
                $sql .= "$key = '$value'";
            }
        }
        
        $sql .= " WHERE id = $id";
        
        echo "<p>$sql</p>";
        
        $statement = $db->prepare($sql);
        $statement->execute();
    }
    
    static public function deleteOne($id) {
        $db = dbConn::getConnection();
        $tableName = get_called_class();
        $sql = 'DELETE FROM ' . $tableName . ' WHERE id =' . $id;
        $statement = $db->prepare($sql);
        $statement->execute();
    }
}
?>
