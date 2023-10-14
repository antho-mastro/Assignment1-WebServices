<?php

namespace Vanier\Api\Controllers;
use Vanier\Api\Models\BaseModel;


class CustomerModel extends BaseModel
{
    private string $table_name = 'customer';

    //!Updated to customers
  
       
    /**
     * getAll
     *
     * @param  mixed $filters
     * @return void
     */
    public function getAll(array $filters) {

        //!Getting all by first name

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
      //!By city
      $filter_values = [];
      $sql = "SELECT * FROM $this->table_name WHERE 1";
      if(isset($filters['city'])){
          //$sql .= " AND :title LIKE CONCAT(':title','%')";
          $sql .= " AND :city LIKE CONCAT('%',':city','%')";
          $filter_values[':city'] = $filters['city'];
      }
      //!by country
      $filter_values = [];
      $sql = "SELECT * FROM $this->table_name WHERE 1";
      if(isset($filters['country'])){
          //$sql .= " AND :title LIKE CONCAT(':title','%')";
          $sql .= " AND :country LIKE CONCAT('%',':country','%')";
          $filter_values[':country'] = $filters['country'];
      }



    }    
    /**
     * getFilmById
     *
     * @param  mixed $customer_id
     * @return void
     */    
   
    public function getFilmById(int $customer_id){
        $sql = "SELECT * FROM $this->table_name WHERE customer_id = customer_id";
    }
    //!Update function customers
    public function updateCustomer(int $customer_id, $data){
        $this->update($this->table_name, $data, ["film_id" => $customer_id]);
    }
  
    //!Delete function customers
    public function deleteCustomer(int $customer_id){
        $this->delete($this->table_name,["film_id" => $customer_id]);
        
    }
    
  
}

?>