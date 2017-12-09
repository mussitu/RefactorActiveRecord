<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class todo extends model {
    public $id;
    public $owneremail;
    public $ownerid;
    public $createddate;
    public $duedate;
    public $message;
    public $isdone;

    public function __construct()
    {
        $this->tableName = 'todos';
	
    }
    
    protected static function format_to_html_table_header() {
        return "<tr><td>id</td><td>owneremail</td>"
                . "<td>ownerid</td><td>createddate</td>"
                . "<td>duedate</td><td>message</td>"
                . "<td>isdone</td></tr>";
    }
    
    protected function format_to_html_table_row() {
        return "<tr><th>$this->id</th><th>$this->owneremail</th>"
                . "<th>$this->ownerid</th><th>$this->createddate</th>"
                . "<th>$this->duedate</th><th>$this->message</th>"
                . "<th>$this->isdone</th></tr>";
    }
    
    public static function format_to_html($something) {
        $result = '<table>' . todo::format_to_html_table_header();
        
        if (is_a($something, 'todo')) {
            $result .= $something->format_to_html_table_row();
        } elseif ($something != NULL) {
            foreach ($something as $row) {
                $result .= $row->format_to_html_table_row();
            }
        }
        
        $result .= '</table>';
        
        return $result;
    }

    public function insert() {
        $record = todos::insertOne(array('owneremail' => $this->owneremail,
                       'ownerid' => $this->ownerid,
                       'createddate' => $this->createdate,
                       'duedate' => $this->duedate,
                       'message' => $this->message,
                       'isdone' => $this->isdone));
        return $record;
    }

    public function update() {
        todos::updateOne($this->id,
                array('owneremail' => $this->owneremail,
                      'ownerid' => $this->ownerid,
                      'createddate' => $this->createdate,
                      'duedate' => $this->duedate,
                      'message' => $this->message,
                      'isdone' => $this->isdone));
        return $this;
    }

    public function delete() {
       todos::deleteOne($this->id);
    }
}
?>
