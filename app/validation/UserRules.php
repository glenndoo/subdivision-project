<?php namespace App\validation;

use App\Models\CustomModel;

class UserRules{

  public function validateUser(string $str, string $fields, array $data){
    $db = db_connect();
    $model = new CustomModel($db);
    $user = $model->searchUser($data);


        if(!$user)
          return false;

          return password_verify($data['password'],$user['password']);


  }
    public function validateQuantity(string $str, string $fields, array $data){
        if($data['quantity'] > $data['stock']){
            return false;
        }else{
            return true;
        }
  }
  
    public function validatePrice(string $str, string $fields, array $data){
        $total = $data['quantity'] * $data['price'];
        if($data['amount'] < $total){
            return false;
        }else{
            return true;
        }
  }
}

 ?>
