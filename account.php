<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class account extends model {
    public $id;
    public $email;
    public $fname;
    public $lname;
    public $phone;
    public $birthday;
    public $gender;
    public $password;

    public function __construct()
    {
        $this->tableName = 'accounts';
	
    }

    public function insert() {
        $record = todos::insertOne(array(email => $this->email,
                                         fname=> $this->fname,
                                         lname=> $this->lname,
                                         phone=> $this->phone,
                                         birthday=> $this->birthday,
                                         gender=> $this->gender,
                                         password=> $this->password));
        return $record;
    }

    public function update() {
        todos::updateOne($this->id,
                		      array(email => $this->email,
                                         fname=> $this->fname,
                                         lname=> $this->lname,
                                         phone=> $this->phone,
                                         birthday=> $this->birthday,
                                         gender=> $this->gender,
                                         password=> $this->password));
        return $this;
    }

    public function delete() {
       todos::deleteOne($this->id);
    }
    
    protected static function format_to_html_table_header() {
        return "<tr><td>id</td><td>email</td>"
                . "<td>fname</td><td>lname</td>"
                . "<td>phone</td><td>birthday</td>"
                . "<td>gender</td><td>password</td></tr>";
    }
    protected function format_to_html_table_row() {
        return "<tr><th>$this->id</th><th>$this->email</th>"
                . "<th>$this->fname</th><th>$this->lname</th>"
                . "<th>$this->phone</th><th>$this->birthday</th>"
                . "<th>$this->gender</th><th>$this->password</th></tr>";
    }
    public static function format_to_html($rows) {
        $result = '<table>' . account::format_to_html_table_header();
        
        if ($rows != NULL) {
            foreach ($rows as $row) {
                $result .= $row->format_to_html_table_row();
            }
        }
        
        $result .= '</table>';
        
        return $result;
    }
}
?>
