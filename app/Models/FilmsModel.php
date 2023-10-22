<?php

namespace Vanier\Api\Models;
use Vanier\Api\Models\BaseModel;


class FilmsModel extends BaseModel
{
    private string $table_name= 'film';
    
   
    private $container;

    public function __construct() {
        parent::__construct();
        
    }
    
    //Getting all titles of books
public function getAll(array $filters) {

    $filter_values = [];
    $sql = "SELECT * FROM $this->table_name WHERE 1";
    if(isset($filters['title'])){
        //$sql .= " AND :title LIKE CONCAT(':title','%')";
        $sql .= " AND :title LIKE CONCAT('%',':title','%')";
        $filter_values[':title'] = $filters['title'];
    }


    //Filtering books by search
    $filter_values = [];
    $sql = "SELECT * FROM $this->table_name WHERE 1";
    if(isset($filters['desc'])){
        //$sql .= " AND :title LIKE CONCAT(':title','%')";
        $sql .= " AND :description LIKE CONCAT('%',':description','%')";
        $filter_values[':description'] = $filters['desc'];
    }
    
    
    
    return $this->fetchAll($sql,$filter_values);
    
}
public function createFilm(array $new_film){
$this->insert($this->table_name, $new_film);
}

public function getFilmById(int $film_id){
    $sql = "SELECT * FROM $this->table_name WHERE film_id = film_id";
}
//!Function to delete a film done
public function deleteFilm(int $film_id){
    $this->delete($this->table_name,["film_id" => $film_id]);
    //$this->update($this->table_name, $data, ["film_id" => $film_id]);
}
//!function to update a film

public function updateFilm(int $film_id, $data){
    $this->update($this->table_name, $data, ["film_id" => $film_id]);
}
//!update a customer
//!put this in customermodels
/*
public function updateCustomer(int $customer_id, $data){
    $this->update($this->$customers, $data, ["customer_id" => $customer_id]);
}
*/

}
