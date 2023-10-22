<?php

namespace Vanier\Api\Models;
use Vanier\Api\Models\BaseModel;

class ActorsModel extends BaseModel {
    private string $table_name= 'actor';
    

    public function __construct() {
        parent::__construct();
    }
//!Function to create new actor
/**
 * createActor
 *
 * @param  mixed $new_actor
 * @return void
 */
public function createActor(array $new_actor){

     $this->insert($this->table_name, $new_actor);
     }
      
 /**
  * getAll
  *
  * @param  mixed $filters
  * @return void
  */
//!Getting all actors by first name
 public function getAll(array $filters) {

  $filter_values = [];
        $sql = "SELECT * FROM $this->table_name WHERE 1";
        if(isset($filters['first_name'])){
            //$sql .= " AND :title LIKE CONCAT(':title','%')";
            $sql .= " AND :firstname LIKE CONCAT('%',':first_name','%')";
            $filter_values[':first_name'] = $filters['first_name'];
        }
//!Filter by last name
$filter_values = [];
$sql = "SELECT * FROM $this->table_name WHERE 1";
if(isset($filters['last_name'])){
    //$sql .= " AND :title LIKE CONCAT(':title','%')";
    $sql .= " AND :lastname LIKE CONCAT('%',':last_name','%')";
    $filter_values[':last_name'] = $filters['last_name'];
}
    }
}