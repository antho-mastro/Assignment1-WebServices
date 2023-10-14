<?php

use Vanier\Api\Controllers\BaseController;
use Vanier\Api\Models\BaseModel;

class CustomerController extends BaseController{

    
    /**
     * handleUpdateCustomers
     *
     * @return void
     */
    //!Not Finished updated
    public function updateCustomers($table, $data, $where){
        //merge data and where together
        $collection = array_merge($data, $where);

        //collect the values from collection
        $values = array_values($collection);

        //setup fields
        $fieldDetails = null;
        foreach ($data as $key => $value) {
            $fieldDetails .= "$key = ?,";
        }
        $fieldDetails = rtrim($fieldDetails, ',');

        //setup where 
        $whereDetails = null;
        $i = 0;
        foreach ($where as $key => $value) {
            $whereDetails .= $i == 0 ? "$key = ?" : " AND $key = ?";
            $i++;
        }

        $stmt = $this->updateCustomer("UPDATE $table SET $fieldDetails WHERE $whereDetails", $values);

        return $stmt->rowCount();

    }
    
    /**
     * handleDeleteCustomers
     *
     * @return void
     */
//!Not finished delete customers
    public function deleteCustomers($table, $where, $limit = 1){
        $values = array_values($where);

        //setup where 
        $whereDetails = null;
        $i = 0;
        foreach ($where as $key => $value) {
            $whereDetails .= $i == 0 ? "$key = ?" : " AND $key = ?";
            $i++;
        }

        //if limit is a number use a limit on the query
        if (is_numeric($limit)) {
            $limit = "LIMIT $limit";
        }

        $stmt = $this->deleteCustomer("DELETE FROM $table WHERE $whereDetails $limit", $values);

        return $stmt->rowCount();



    }

}

?>