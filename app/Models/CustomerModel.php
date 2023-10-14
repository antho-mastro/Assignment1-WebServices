<?php

namespace Vanier\Api\Controllers;
use Vanier\Api\Models\BaseModel;


class CustomerModel extends BaseModel
{
    private string $table_name = 'customer';

    //!Updated to customers
  
   
    public function getAll(array $filters) {

        $filter_values = [];
        $sql = "SELECT * FROM $this->table_name WHERE 1";
        if(isset($filters['title'])){
            //$sql .= " AND :title LIKE CONCAT(':title','%')";
            $sql .= " AND :title LIKE CONCAT('%',':title','%')";
            $filter_values[':title'] = $filters['title'];
        }
    }
    //!Update function customers
    public function updateFilm(int $custumer_id, $data){
        $this->update($this->table_name, $data, ["film_id" => $customer_id]);
    }
  
    //!Delete function customers
    public function deleteFilm(int $film_id){
        $this->delete($this->table_name,["film_id" => $film_id]);
        //$this->update($this->table_name, $data, ["film_id" => $film_id]);
    }
    
  
}

?>