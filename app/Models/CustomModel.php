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


  //LOGIN FUNCTION
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
                     $user['access'] = $row->user_access;
             }

             
    return $user;
  }


  // LOGIN LOGGER
  function loginTrack($data){
      $this->db->table('login_tracker')
              
                  ->insert($data);
  }

  //UPDATE USER INFORMATION
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

  
  //INSERT NEW ITEM TO DB
  function saveItem($data, $transaction){
    $this->db->table('items')
             ->insert($data);

    $this->db->table('inventory_transaction')
             ->insert($transaction);
  }
  

  //DELETE ITEM FROM DB
    function deleteItem($data){
    $user = $this->db->table('items')
                     ->set($data)
                     ->where('item_code =', $data)
                     ->delete();


    $user = $this->db->table('inventory_transaction')
                     ->set($data)
                     ->where('item_code =', $data)
                     ->delete();

    return $user;

  }
  

  //QUERY ALL ITEMS FROM DB
  function searchItem($data){
    $item = $this->db->table('items')
             ->like('item_name', $data)
             ->get()
             ->getResult();
    return $item;
  }
  
  
  //DISPLAY ORDER PAGE
  function purchaseItem($data){
    $item = $this->db->table('items')
             ->where('item_id', $data)
             ->get()
             ->getResult();
    return $item;
  }
  

  //INSERT ORDER TO DB
  function placeOrder($data, $stock, $current){
    $counter = $this->db->table('sales')
                    ->countAllResults();
    
    $data['sales_id'] = 'WHAI00'.($counter+1);
    
    $this->db->table('sales')
             ->insert($data);

             $items = [
              'item_code' => $data['sales_item'],
              'item_added_qty' => intval($data['sales_quantity'])*(-1),
              'item_prev_count' => $current,
              'item_current_count' => $stock,
              'transaction_type' => 1
          ];

    $this->db->table('inventory_transaction')
            ->insert($items);

    $this->db->table('items')
                     ->set('item_quantity', $stock)
                     ->where('item_id =', $data['sales_item'])
                     ->update();
  }
  

  //DISPLAY ALL SALES DATA
  function showAllSales($date){
  if(strlen($date) == 10){
    $details = $this->db->table('members')
                      ->select('sales_id AS salesid, sales_date AS Date, CONCAT(member_last, ", ", member_first) AS name,sales_member_id AS memberid, item_name as Item, sales_quantity as Quantity, sales_amount_paid AS Paid, sales_credit_amount as Credit, sales_payment_type as PaymentType')                    
                      ->where('DATE(sales_date) = "'. date($date) .'"')
                      ->join('sales', 'sales.sales_member_id = member_id')
                      ->join('items', 'items.item_id = sales.sales_item')
                      ->join('users', 'users.user_id = sales_by')
                      ->orderBy('sales_date', 'ASC')
                      ->get()
                      ->getResult();
  }else if(strlen($date) == 2){
    $details = $this->db->table('members')
                      ->select('sales_id AS salesid, sales_date AS Date, CONCAT(member_last, ", ", member_first) AS name,sales_member_id AS memberid, item_name as Item, sales_quantity as Quantity, sales_amount_paid AS Paid, sales_credit_amount as Credit, sales_payment_type as PaymentType')                    
                      ->where('MONTH(sales_date) = "'. date($date) .'"')
                      ->join('sales', 'sales.sales_member_id = member_id')
                      ->join('items', 'items.item_id = sales.sales_item')
                      ->join('users', 'users.user_id = sales_by')
                      ->orderBy('sales_date', 'ASC')
                      ->get()
                      ->getResult();
  }else{
      $details = $this->db->table('members')
      ->select('sales_id AS salesid, sales_date AS Date, CONCAT(member_last, ", ", member_first) AS name,sales_member_id AS memberid, item_name as Item, sales_quantity as Quantity, sales_amount_paid AS Paid, sales_credit_amount as Credit, sales_payment_type as PaymentType')                    
      ->where('YEAR(sales_date) = "'. date($date) .'"')
      ->join('sales', 'sales.sales_member_id = member_id')
      ->join('items', 'items.item_id = sales.sales_item')
      ->join('users', 'users.user_id = sales_by')
      ->orderBy('sales_date', 'ASC')
      ->get()
      ->getResult();
    }
  
                
                $dt = $this->db->table('sales')
                      ->select('SUM(sales_amount_paid) AS TotalCash')
                      ->get()
                      ->getResult();
      
      return json_encode($details);
  }
  

  //SEARCH BY DATE
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
  
  //LOGOUT LOGGER
  function logout($data){
             $this->db->table('login_tracker')
                  ->insert($data);
  }
  
  //SHOW ALL MEMBERS
  function showMembers(){
      $details = $this->db->table('members')
                      ->select('member_id AS Member, CONCAT(member_last, ", ",  member_first) AS Name, sum(sales_credit_amount) AS Total')
                      ->join('sales', 'sales.sales_member_id = member_id')
                      ->orderBy('member_last')
                      ->groupBy('sales.sales_member_id')
                      ->get()
                      ->getResult();
      
      return json_encode($details);
  }
  

  //LOGIN LOGGER
  function loginDetails($data){
      $details = $this->db->table('login_tracker')
                      ->select("tracker_user_id AS Id, tracker_status AS Status, tracker_date AS Date, tracker_id")
                      ->where('tracker_user_id', $data['user'])
                      ->get()
                      ->getResult();
      
      return json_encode($details);
  }
  

  //SHOW ALL MEMBER DETAILS
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
  

  //SHOW MEMBER PURCHASE DATE
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
  
  

  //SHOW ALL MEMBER PURCHASE DATA
  function showSearchDate($data){
      
                      $details = $this->db->table('members')
                      ->where('DATE(sales_date) = date("'.date("y-m-d").'")')
                      ->join('sales', 'sales.sales_member_id = member_id')
                      ->join('items', 'items.item_id = sales.sales_item')
                      ->join('users', 'users.user_id = sales_by')
                      ->orderBy('sales_date', 'desc')
                      ->get()
                      ->getResult();
      
      return json_encode($details);
  }
  

  //SHOW MEMBERS WHO PURCHASED
    function showMemberOrder(){
      $details = $this->db->table('members')
                      ->get()
                      ->getResult();
      
      return $details;
  }
  
  function json(){
      $items = $this->db->table("items")
         ->join('users', 'items.item_added_by = users.user_id')
         ->select('CONCAT(users.user_last, ", ", users.user_first) AS Username, item_name AS Name, item_id as Code, item_quantity as Quantity, item_price as Price, item_type AS Category')
         ->orderBy("item_name")
         ->get()
         ->getResult();
    
    return json_encode($items);
    
  }
  

  //UPDATE INVENTORY
  function updateInventory($update, $inventory){
      $this->db->table("inventory_transaction")
               ->insert($update);
               
      $this->db->table("items")
               ->set($inventory)
               ->where('item_id =', $inventory['item_code'])
               ->update();
  }


  //MAKE PAYMENT
  function makePayment($data){
    $amountPaid = $data['sales_amount_paid'];
    $counter = $this->db->table('sales')
                    ->countAllResults();
      $dt = 0;
      $rows = 0;
      $deduct = $this->db->table('sales')
                      ->select('SUM(sales_credit_amount) AS credit')
                      ->where('sales_member_id', $data['sales_member_id'])
                      ->get()
                      ->getResult();

      foreach($deduct as $dd){
        $dt = $dd->credit;
      }

      $count = $this->db->table('sales')
      ->where('sales_member_id', $data['sales_member_id'])
      ->where('sales_payment_type', "credit")
      ->get()
      ->getResult();



    foreach($count as $ct){
      $rows += 1;
    }

    $check =  $dt - $amountPaid;
    
    if($check >= 1){

      $this->db->table("sales")
      ->set('sales_credit_amount',$check/$rows)
      ->where('sales_member_id =', $data['sales_member_id'])
      ->where('sales_payment_type', 'credit')
      ->update();

      $data['sales_id'] = 'WHAI00'.($counter+1);
      $this->db->table("sales")
               ->insert($data);
    }else if($check == 0){
      $this->db->table("sales")
      ->set('sales_credit_amount', 0)
      ->set('sales_payment_type', "cash")
      ->where('sales_member_id =', $data['sales_member_id'])
      ->where('sales_payment_type', 'credit')
      ->update();
      $data['sales_id'] = 'WHAI00'.($counter+1);
    $this->db->table("sales")
               ->insert($data);
    }else{
      $this->db->table("sales")
      ->set('sales_credit_amount', $check/$rows)
      ->where('sales_member_id =', $data['sales_member_id'])
      ->where('sales_payment_type', 'credit')
      ->update();
      $data['sales_id'] = 'WHAI00'.($counter+1);
    $this->db->table("sales")
               ->insert($data);
    }

    
  }


  //INVENTORY REPORT
  function inventoryReport($data){
    if(strlen($data) != null){
      $date = substr($data, -2);
      $report = $this->db->table('items')
      ->join("inventory_transaction", "inventory_transaction.item_code = item_id")
      ->join("users", "user_id = transaction_by", "left")
      ->where('MONTH(transaction_date) = "'.$date.'"')
      ->where('transaction_type', 0)
      ->orderBy("transaction_date","ASC")
      ->select('item_name AS Item, CONCAT(user_last, ", ", user_first) AS Person, item_prev_count as Replenish, sum(item_added_qty) AS Present, (sum(item_added_qty) + item_prev_count) AS Stock, item_quantity AS Current, (item_prev_count + sum(item_added_qty) - item_quantity) AS Sold')
      ->groupBy('item_name')
      ->get()
      ->getResult();
    }else{
      $report = $this->db->table('items')
      ->join("inventory_transaction", "inventory_transaction.item_code = item_id")
      ->join("users", "user_id = transaction_by", "left")
      ->where('MONTH(transaction_date) = "'.substr(date("yy-m"), -2).'"')
      ->where('transaction_type', 0)
      ->orderBy("transaction_date","ASC")
      ->select('item_name AS Item, CONCAT(user_last, ", ", user_first) AS Person, item_prev_count as Replenish, sum(item_added_qty) AS Present, (sum(item_added_qty) + item_prev_count) AS Stock, item_quantity AS Current, (item_prev_count + sum(item_added_qty) - item_quantity) AS Sold')
      ->groupBy('item_name')
      ->get()
      ->getResult();
    }
    

    return json_encode($report);
    
  }

  function cart($data){
    foreach($data as $dt){
      $this->db->table("cart")
      ->insert($dt);
    }
    
  }

  function jsonCart(){
    $result = $this->db->table("cart")
             ->join("items", "cart.item_code = item_id")
             ->join("members", "cart.member_id = members.member_id")
             ->get()
             ->getResult();

    $resultCount = $this->db->table('cart')
             ->countAllResults();

    
    return array(
      'records' => $result, 
      'counter' => $resultCount);

  }


  function tryOrder($data,$items,$inv){
    

    foreach($data as $dt){
      $counter = $this->db->table('sales')
                    ->countAllResults();
      $dt['sales_id'] = 'WHAI00'.($counter+1);
      $this->db->table('sales')
      ->insert($dt);
    }
    




    foreach($items as $it){
      $this->db->table('inventory_transaction')
               ->insert($it);
    }

    
    foreach($inv as $in){
      $this->db->table('items')
      ->set('item_quantity', $in['item_quantity'])
      ->where('item_id =', $in['item_id'])
      ->update();
    }
      
    


  }
}