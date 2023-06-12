<?php
require_once('../database/Database.php');
require_once('../database/AccountsDB.php');
class TypesDB extends Database {
    protected $tableName = 'types';

    public function getAll() {
        return $this -> fetchAll($this -> tableName, "1", "1");
    }
} 
?>