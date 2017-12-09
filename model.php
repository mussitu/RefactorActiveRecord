<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

abstract class model {
    protected $tableName;
    public function save()
    {
        if ($this->id == '') {
            $sql = $this->insert();
        } else {
            $sql = $this->update();
        }

        $db = dbConn::getConnection();
        $statement = $db->prepare($sql);
        $statement->execute();

        $this->tableName = get_called_class();

        $array = get_object_vars($this);
        $columnString = implode(',', $array);
        $valueString = ":".implode(',:', $array);
       // echo "INSERT INTO $this->tableName (" . $columnString . ") VALUES (" . $valueString . ")</br>";

        echo 'I just saved record: ' . $this->id;
    }

    public function insert() {
        $sql = 'sometthing';
        return $sql;
    }

    public function update() {
        $sql = 'sometthing';
        return $sql;
        echo 'I just updated record' . $this->id;
    }

    public function delete() {
        echo 'I just deleted record' . $this->id;
    }
    
    protected abstract static function format_to_html_table_header();
    protected abstract function format_to_html_table_row();
    public abstract static function format_to_html($rows);
}
?>
