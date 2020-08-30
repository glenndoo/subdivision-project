<?php namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;

class CustomModel{
  protected $db;
  protected $beforeInsert = ['beforeInsert'];
  protected $beforeUpdate = ['beforeUpdate'];

  public function __construct(ConnectionInterface & $db){
    $this->db =& $db;
  }

  function save(array $data){
    $this->db->table('users')
             ->insert($data);
  }

  function searchUser($data){
    $user = $this->db->table('users')
             ->where('user_login =', $data['username'])
             ->get()
             ->getResult();
             foreach ($user as $row)
             {
                     $user['username'] = $row->user_login;
                     $user['password'] = $row->password;
             }
    return $user;

  }

  function model($data){
    $user = $this->db->table('users')
             ->where('user_login =', $data)
             ->get()
             ->getResult();
             foreach ($user as $row)
             {
                     $user['first'] = $row->user_first;
                     $user['last'] = $row->user_last;
                     $user['login'] = $row->user_login;
                     $user['id'] = $row->user_id;
             }

             
    return $user;
  }

  function loginTrack($data){
      $this->db->table('login_tracker')
              
                  ->insert($data);
  }
  function update($data, $val){
    $user = $this->db->table('users')
                     ->set($data)
                     ->where('user_login =', $val)
                     ->update();

    return $user;

  }

  
    //SHOW ALL ITEMS IN INVENTORY
  function showAll(){
    $items = $this->db->table("items")
         ->join('users', 'items.item_added_by = users.user_id')
         ->select('item_code AS Code, item_name AS Name, item_type AS Category, item_price AS Price, users.user_last AS Username, item_quantity AS Quantity')
         ->get()
         ->getResult();
    
    return json_encode($items);
    
  }

  
  
  function saveItem(array $data){
    $this->db->table('items')
             ->insert($data);
  }
  
    function deleteItem($data){
    $user = $this->db->table('items')
                     ->set($data)
                     ->where('item_code =', $data)
                     ->delete();

    return $user;

  }
  
  function searchItem($data){
    $item = $this->db->table('items')
             ->like('item_name', $data)
             ->get()
             ->getResult();
    return $item;
  }
  
  
  //display order page
  function purchaseItem($data){
    $item = $this->db->table('items')
             ->where('item_code', $data)
             ->get()
             ->getResult();
    return $item;
  }
  
  function placeOrder($data, $stock){
    $counter = $this->db->table('sales')
                    ->countAllResults();
    
    $data['sales_id'] = 'WHAI00'.$counter;
    
    $this->db->table('sales')
             ->insert($data);
    
    
    $this->db->table('items')
                     ->set('item_quantity', $stock)
                     ->where('item_id =', $data['sales_item'])
                     ->update();
  }
  
  function showAllSales(){

                $details = $this->db->table('members')
                      ->select('sales_id AS salesid, sales_date AS Date, CONCAT(member_last, ", ", member_first) AS name,sales_member_id AS memberid, item_name as Item, sales_quantity as Quantity, sales_amount_paid AS Paid, sales_credit_amount as Credit, sales_payment_type as PaymentType')                    
                      ->where('YEAR(sales_date) = "'. date("Y/m") .'"')
                      ->join('sales', 'sales.sales_member_id = member_id')
                      ->join('items', 'items.item_id = sales.sales_item')
                      ->join('users', 'users.user_id = sales_by')
                      ->orderBy('sales_date', 'ASC')
                      ->get()
                      ->getResult();
                $dt = $this->db->table('sales')
                      ->select('SUM(sales_amount_paid) AS TotalCash')
                      ->get()
                      ->getResult();
      
      return json_encode($details);
  }
  
  function searchDate($data){
         $item = $this->db->table('sales')
             ->like('sales_date', $data)
             ->join('items', 'items.item_id = sales_item')
             ->join('users', 'users.user_id = sales_by')
             ->orderBy('sales_date', 'ASC')
             ->get()
             ->getResult();
                 
    return $item;
  }
  
  
  function logout($data){
             $this->db->table('login_tracker')
                  ->insert($data);
  }
  
  
  function showMembers(){
      $details = $this->db->table('members')
                      ->select('member_id, member_last, member_first, sum(sales_credit_amount) AS "totalCredit"')
                      ->join('sales', 'sales.sales_member_id = member_id')
                      ->orderBy('member_last')
                      ->groupBy('sales.sales_member_id')
                      ->get()
                      ->getResult();
      
      return $details;
  }
  
  function loginDetails($data){
      $details = $this->db->table('login_tracker')
                      ->select("tracker_user_id AS Id, tracker_status AS Status, tracker_date AS Date, tracker_id")
                      ->where('tracker_user_id', $data['user'])
                      ->get()
                      ->getResult();
      
      return json_encode($details);
  }
  
  function showMemberDetails($data){
      $details = $this->db->table('members')
                      ->where('member_id', $data)
                      ->join('sales', 'sales.sales_member_id = member_id')
                      ->join('items', 'items.item_id = sales.sales_item')
                      ->join('users', 'users.user_id = sales_by')
                      ->orderBy('sales_date', 'ASC')
                      ->get()
                      ->getResult();
      
      return $details;
  }
  
  function showMemberDate($data){
      $date = substr($data['now'], -2);

      $details = $this->db->table('members')
                      ->where('member_id', $data['id'])
                      ->where('MONTH(sales_date) = "'. $date .'"')
                      ->join('sales', 'sales.sales_member_id = member_id')
                      ->join('items', 'items.item_id = sales.sales_item')
                      ->join('users', 'users.user_id = sales_by')
                      ->orderBy('sales_date', 'ASC')
                      ->get()
                      ->getResult();
      
      return $details;
  }
  
  
  function showSearchDate($data){
      $date = substr($data['now'], -2);
      
                      $details = $this->db->table('members')
                      ->join('sales', 'sales.sales_member_id = member_id')
                      ->join('items', 'items.item_id = sales.sales_item')
                      ->join('users', 'users.user_id = sales_by')
                      ->orderBy('sales_date', 'desc')
                      ->get()
                      ->getResult();
      
      return $details;
      
  }
  
    function showMemberOrder(){
      $details = $this->db->table('members')
                      ->get()
                      ->getResult();
      
      return $details;
  }
  
  function json(){
      $items = $this->db->table("items")
         ->join('users', 'items.item_added_by = users.user_id')
         ->select('CONCAT(users.user_last, ", ", users.user_first) AS Username, item_name AS Name, item_code as Code, item_quantity as Quantity, item_price as Price, item_type AS Category')
         ->orderBy("item_name")
         ->get()
         ->getResult();
    
    return json_encode($items);
    
  }
  
  function updateInventory($update, $inventory){
      
      $this->db->table("inventory_transaction")
               ->insert($update);
               
      $this->db->table("items")
               ->set($inventory)
               ->where('item_code =', $inventory['item_code'])
               ->update();
  }
}
