<?php
class Continent extends Model{
    public function __construct(){
        $this->table = "continent";
        $this->getConnection();
    }
}