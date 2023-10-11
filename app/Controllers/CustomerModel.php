<?php

namespace Vanier\Api\Controllers;
use Vanier\Api\Models\BaseModel;


class CustomerModel extends BaseModel
{
    private string $customers = 'customer';

    //!Need to Update this !!!
    public function getAll(array $filters) {

        $filter_values = [];
        $sql = "SELECT * FROM $this->customers WHERE 1";
        if(isset($filters['title'])){
            //$sql .= " AND :title LIKE CONCAT(':title','%')";
            $sql .= " AND :title LIKE CONCAT('%',':title','%')";
            $filter_values[':title'] = $filters['title'];
        }
    }
    //need to add this
}

?>