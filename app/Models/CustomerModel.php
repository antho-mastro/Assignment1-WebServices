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
    public function getFilmById(int $customer_id){
        $sql = "SELECT * FROM $this->table_name WHERE customer_id = customer_id";
    }
    //!Update function customers
    public function updateFilm(int $customer_id, $data){
        $this->update($this->table_name, $data, ["film_id" => $customer_id]);
    }
  
    //!Delete function customers
    public function deleteCustomer(int $customer_id){
        $this->delete($this->table_name,["film_id" => $customer_id]);
        
    }
    
  
}

?>