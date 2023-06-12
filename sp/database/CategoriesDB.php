<?php
require_once('../database/Database.php');
require_once('../database/AccountsDB.php');
class CategoriesDB extends Database {
    protected $tableName = 'categories';

    public function getByID(int $id) {
        return $this -> fetchOne($this -> tableName, "category_id", $id);
    }
} 
?>