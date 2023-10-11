<?php

namespace Vanier\Api\Controllers;
use Vanier\Api\Models\BaseModel;


class FilmsModel extends BaseModel
{
    private string $table_name= 'film';
    private string $actors = 'actor';
    private string $customers = 'customer';
    private $container;

    public function __construct($container) {
        parent::__construct();
        $this->container = $container;
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

        $data = [];
         $pdo = $this->container->get('sakila');
    
        $sql = "INSERT INTO films (title, description, release_year, language_id, original_language_id, rental_duration, rental_rate, length, replacement_cost, rating, special_features) 
                VALUES (:title, :description, :release_year, :language_id, :original_language_id, :rental_duration, :rental_rate, :length, :replacement_cost, :rating, :special_features)";
    
        $stmt = $pdo->prepare($sql);
    
        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':release_year', $data['release_year']);
        $stmt->bindParam(':language_id', $data['language_id']);
        $stmt->bindParam(':original_language_id', $data['original_language_id']);
        $stmt->bindParam(':rental_duration', $data['rental_duration']);
        $stmt->bindParam(':rental_rate', $data['rental_rate']);
        $stmt->bindParam(':length', $data['length']);
        $stmt->bindParam(':replacement_cost', $data['replacement_cost']);
        $stmt->bindParam(':rating', $data['rating']);
        $stmt->bindParam(':special_features', $data['special_features']);
    
        if ($stmt->execute()) {
            return [
                'status' => 'success',
                'message' => 'Film created successfully',
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Failed to create the film',
            ];
        }
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
public function updateCustomer(){
    $this->
}
public function createActor(){

}

}
