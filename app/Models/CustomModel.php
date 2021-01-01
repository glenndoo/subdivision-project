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

  
    //SHOW SMART LOAD
  function showSmart(){
    $items = $this->db->table("items")
         ->where("item_type", 10)
         ->where("item_id", 1054)
         ->get()
         ->getResult();
    
    return $items;
    
  }

   //SHOW GLOBE LOAD
  function showGlobe(){
    $items = $this->db->table("items")
         ->where("item_type", 10)
         ->where("item_id", 536)
         ->get()
         ->getResult();
    
    return $items;
    
  }

  
  //INSERT NEW ITEM TO DB
  function saveItem($data, $transaction, $replenishment){
    $this->db->table('items')
             ->insert($data);

    $this->db->table('inventory_transaction')
             ->insert($transaction);

    $this->db->table('replenishment')
             ->insert($replenishment);
  }
  

  //DELETE ITEM FROM DB
    function deleteItem($data){
    $user = $this->db->table('items')
                     ->set($data)
                     ->where('item_id =', $data)
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
    $counter = $this->db->table('receipts')
        ->select("DISTINCT(receipt_number)")
        ->get()
        ->getResult();
    
                    $data['sales_receipt'] = 'WMPC00'.count($counter);
    
    $dt = [
      'receipt_number' => $data['sales_receipt']
    ];

    $this->db->table("receipts")
             ->insert($dt);

    $this->db->table('sales')
             ->insert($data);

          //    $items = [
          //     'item_code' => $data['sales_item'],
          //     'item_added_qty' => intval($data['sales_quantity'])*(-1),
          //     'item_prev_count' => $current['item_quantity'],
          //     'item_current_count' => $stock,
          //     'transaction_type' => 1
          // ];

    $this->db->table('inventory_transaction')
            ->insert($stock);

    $this->db->table('items')
                     ->set('item_quantity', $stock['item_current_count'])
                     ->where('item_id =', $data['sales_item'])
                     ->update();
  }
  

  //DISPLAY ALL SALES DATA
  function showAllSales($date){
  if(strlen($date) == 10){
    $details = $this->db->table('members')
                      ->select('sales_receipt AS salesid, sales_date AS Date, CONCAT(member_last, ", ", member_first) AS name,sales_member_id AS memberid, item_name as Item, sales_quantity as Quantity, sales_amount_paid AS Paid, sales_credit_amount as Credit, sales_payment_type as PaymentType, sales_id AS sId, sales_item AS itemId')                    
                      ->where('DATE(sales_date) = "'. date($date) .'"')
                      ->join('sales', 'sales.sales_member_id = member_id')
                      ->join('items', 'items.item_id = sales.sales_item')
                      ->join('users', 'users.user_id = sales_by')
                      ->orderBy('sales_date', 'ASC')
                      ->get()
                      ->getResult();
  }else if(strlen($date) == 2){
    $details = $this->db->table('members')
                      ->select('sales_receipt AS salesid, sales_date AS Date, CONCAT(member_last, ", ", member_first) AS name,sales_member_id AS memberid, item_name as Item, sales_quantity as Quantity, sales_amount_paid AS Paid, sales_credit_amount as Credit, sales_payment_type as PaymentType, sales_id AS sId, sales_item AS itemId')                    
                      ->where('MONTH(sales_date) = "'. date($date) .'"')
                      ->join('sales', 'sales.sales_member_id = member_id')
                      ->join('items', 'items.item_id = sales.sales_item')
                      ->join('users', 'users.user_id = sales_by')
                      ->orderBy('sales_date', 'ASC')
                      ->get()
                      ->getResult();
  }else{
      $details = $this->db->table('members')
      ->select('sales_receipt AS salesid, sales_date AS Date, CONCAT(member_last, ", ", member_first) AS name,sales_member_id AS memberid, item_name as Item, sales_quantity as Quantity, sales_amount_paid AS Paid, sales_credit_amount as Credit, sales_payment_type as PaymentType, sales_id AS sId, sales_item AS itemId')                    
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
                      ->select('member_id AS Member, CONCAT(member_last, ", ",  member_first) AS Name, member_credit AS Total')
                      ->join('sales', 'sales.sales_member_id = member_id')
                      ->orderBy('member_last')
                      ->groupBy('sales.sales_member_id')
                      ->get()
                      ->getResult();
      
      return json_encode($details);
  }
  
  function allMembers($date){
    $dt = date($date);
    $finDate = substr($dt, -2);
    $details = $this->db->table('members')
                      ->select('member_id AS Member, CONCAT(member_last, ", ",  member_first) AS Name, member_credit AS Total, SUM(sales_amount_paid) AS Payment')
                      ->where("MONTH(sales_date) = ", $finDate)
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
    $dt = strlen($data);

    if($dt > 2){
      $details = $this->db->table('members')
      ->where('sales_receipt', $data)
      ->join('sales', 'sales.sales_member_id = member_id')
      ->join('items', 'items.item_id = sales.sales_item')
      ->join('users', 'users.user_id = sales_by')
      ->orderBy('sales_date', 'ASC')
      ->get()
      ->getResult();

return $details;
    }else{
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
                      ->orderBy("member_last", "ASC")
                      ->get()
                      ->getResult();
      
      return $details;
  }
  
  function json(){
      $items = $this->db->table("items")
         ->join('users', 'items.item_added_by = users.user_id')
         ->select('CONCAT(users.user_last, ", ", users.user_first) AS Username, item_name AS Name, item_id as id, item_code as Code, item_quantity as Quantity, item_price as Price, item_type AS Category, item_unit_price AS Old')
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
               ->where('item_name =', $inventory['item_name'])
               ->update();

      $trans = [
        'item_code' => $inventory['item_id']
      ];


              }

  //REPLENISH ITEM
  function replenish($item,$trans){

    
    $this->db->table('items')
            ->where('item_id', $item['item_id'])
            ->set('item_quantity', $item['item_quantity'])
            ->update();

    $this->db->table('inventory_transaction')
             ->insert($trans);

  }

  //MAKE PAYMENT
  function makePayment($data){

  

    $amountPaid = $data['sales_amount_paid'];
        $counter = $this->db->table('receipts')
        ->select("DISTINCT(receipt_number)")
        ->get()
        ->getResult();
      $dt = 0;
      $rows = 0;
      $deduct = $this->db->table('members')
                      ->select('member_credit AS credit')
                      ->where('member_id', $data['sales_member_id'])
                      ->get()
                      ->getResult();

      foreach($deduct as $dd){
        $dt = $dd->credit;
      }

      $count = $this->db->table('receipts')
                    ->select("DISTINCT(receipt_number)")
                    ->get()
                    ->getResult();
    $rt = [
      'receipt_number' => $data['sales_receipt']
    ];

    $this->db->table('receipts')
              ->insert($rt);


    $check =  $dt - $amountPaid;
    
    if($check >= 1){

      // $this->db->table("sales")
      // ->set('sales_credit_amount',$check/count($count))
      // ->where('sales_member_id =', $data['sales_member_id'])
      // ->where('sales_payment_type', 'credit')
      // ->update();

      $data['sales_receipt'] = $data['sales_receipt'];
      $this->db->table("sales")
               ->insert($data);
               $this->db->table("members")
               ->set("member_credit", $check)
               ->where("member_id", $data['sales_member_id'])
               ->update();
      



    }else if($check == 0){
      $this->db->table("sales")
      ->set('sales_credit_amount', 0)
      ->set('sales_payment_type', "cash")
      ->where('sales_member_id =', $data['sales_member_id'])
      ->where('sales_payment_type', 'credit')
      ->update();
      $this->db->table("members")
               ->set("member_credit", $check)
               ->where("member_id", $data['sales_member_id'])
               ->update();

               $data['sales_receipt'] = $data['sales_receipt'];
    $this->db->table("sales")
               ->insert($data);
              //  $this->db->table("receipts")
              //  ->insert($data['sales_receipt']);
    }else{
      // h
              //  $this->db->table("receipts")
              //  ->insert($data['sales_receipt']);
    }

    
  }


  //INVENTORY REPORT
  function inventoryReport($data){
    if(strlen($data) != null){
      $date = substr($data, -2);
      $formerDate = $date - 1;
      $report = $this->db->table('items')
      ->join("inventory_transaction", "inventory_transaction.item_code = item_id")
      ->join("users", "user_id = transaction_by", "left")
      ->join("replenishment", "replenishment_item = item_id", "left")
      ->where('MONTH(transaction_date) = "'.$formerDate.'"')
      ->where('MONTH(replenishment_date) = "'.$formerDate.'"')
      ->where('transaction_type', 0)
      ->orderBy("transaction_date","ASC")
      ->select('item_id AS id, item_name AS Item, CONCAT(user_last, ", ", user_first) AS Person, replenishment_last_count as Replenish, sum(item_added_qty) AS Present, (sum(item_added_qty) + replenishment_last_count) AS Stock, item_quantity AS Current, (replenishment_last_count + sum(item_added_qty) - item_quantity) AS Sold, item_unit_price AS Price,  ((item_quantity)* item_unit_price) AS Tot')
      ->groupBy('item_name')
      ->get()
      ->getResult();
    }else{
      $current = substr(date("yy-m"), -2);
      $actual = $current - 1;
      $report = $this->db->table('items')
      ->join("inventory_transaction", "inventory_transaction.item_code = item_id")
      ->join("users", "user_id = transaction_by", "left")
      ->where('MONTH(transaction_date) = "'.$current.'"')
      ->where('MONTH(replenishment_date) = "'.$actual.'"')
      ->where('transaction_type', 1)
      ->orderBy("transaction_date","ASC")
      ->select('item_id AS id, item_name AS Item, CONCAT(user_last, ", ", user_first) AS Person, replenishment_last_count as Replenish, sum(item_added_qty) AS Present, (sum(item_added_qty) + replenishment_last_count) AS Stock, item_quantity AS Current, (replenishment_last_count + sum(item_added_qty) - item_quantity) AS Sold, item_unit_price AS Price, ((item_quantity)* item_unit_price) AS Tot')
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


  //SHOPPING CART
  function tryOrder($data,$items,$inv){
    $counter = $this->db->table('receipts')
                    ->select("DISTINCT(receipt_number)")
                    ->get()
                    ->getResult();
    $dt['receipt_number'] = "WMPC00".count($counter);

    $this->db->table('receipts')
              ->insert($dt);


    foreach($data as $dt){
      $dt['sales_receipt'] = "WMPC00".count($counter);
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
    $num = 0;  
    $id = "";
    $cred = 0;
    foreach($data as $d){
      $id = $d['sales_member_id'];
      $num += $d['sales_credit_amount'];
    }
    

    $crd = $this->db->table("members")
                    ->where("member_id", $id)
                    ->get()
                    ->getResult();

    foreach($crd as $c){
      $cred += $c->member_credit;
    }
    $final = $num+$cred;
    $credit = [
      'member_credit' => $final
    ];
    $this->db->table("members")
            ->where("member_id", $id)
            ->update($credit);
  }



  // REMOVE SALES ITEM
  function removeSale($remove, $add, $update, $credit){
    $check = $this->db->table("sales")
                      ->where("sales_receipt", $remove['sales_receipt'])
                      ->get()
                      ->getResult();

    if(count($check) == 1){
      $this->db->table('sales')
            ->set($remove)
            ->where('sales_id', $remove['sales_id'])
            ->delete();

      $dt = [
          'receipt_number' => $remove['sales_receipt']
      ];


      $this->db->table("receipts")
               ->set($dt)
               ->where("receipt_number", $dt)
               ->update();

    $current = $this->db->table('items')
             ->select('item_quantity')
             ->where('item_id', $add['item_code'])
             ->get()
             ->getResult();
    
    $num = 0;
    foreach($current as $cr){
      $num = $cr->item_quantity;
    }

    $add['item_quantity'] = $num + $update['item_quantity'];


 
    $this->db->table('items')
            ->set('item_quantity', $add['item_quantity'])
            ->where('item_id', $add['item_code'])
            ->update();
    }else{
      $this->db->table('sales')
            ->set($remove)
            ->where('sales_id', $remove['sales_id'])
            ->delete();

    $current = $this->db->table('items')
             ->select('item_quantity')
             ->where('item_id', $add['item_code'])
             ->get()
             ->getResult();
    
    $num = 0;
    foreach($current as $cr){
      $num = $cr->item_quantity;
    }

    $add['item_quantity'] = $num + $update['item_quantity'];


 
    $this->db->table('items')
            ->set('item_quantity', $add['item_quantity'])
            ->where('item_id', $add['item_code'])
            ->update();
    }

    $finCred = $this->db->table('members')
                    ->select('member_credit')
                    ->where('member_id', $credit['member_id'])
                    ->get()
                    ->getResult();
    $crt = 0;              
    foreach($finCred as $crd){
      $crt = $crd->member_credit;
    }
    $removeCred = $crt - $credit['member_credit'];
    $this->db->table('members')
             ->set('member_credit', $removeCred)
             ->where('member_id', $credit['member_id'])
             ->update();
  }


  function itemSummary($item){
    $result = $this->db->table("inventory_transaction")
                       ->join("users", "user_id = transaction_by")
                       ->select("item_prev_count AS prev, item_added_qty AS added, transaction_date AS date, transaction_type AS type, CONCAT(user_last, ',', user_first) AS trans")
                       ->where("item_code", $item)
                       ->get()
                       ->getResult();

    return json_encode($result);
  }


  function stampInv(){
    $date = date_create(date("yy-m-d"));
    $fin = date_add($date,date_interval_create_from_date_string("1 days"));
    $finDate = $fin->format("yy-m-d");
    echo $finDate;
    $result = $this->db->table('items')
             ->select('item_id AS replenishment_item, item_quantity AS replenishment_last_count')
             ->get()
             ->getResult();
    
    // $data = [];

    //     foreach($result as $res){
    //     $data['replenishment_item'] = $res->item_id;
    //     $data['replenishment_last_count'] = $res->item_quantity;
    //     }

        foreach($result as $rs){
          $data = [
            'replenishment_item' => $rs->replenishment_item,
            'replenishment_last_count' => $rs->replenishment_last_count
          ];
          $trans =[
            'transaction_by' => session()->get('id'),
            'item_code' => $rs->replenishment_item,
            'item_current_count' => $rs->replenishment_last_count,
            'item_prev_count' => $rs->replenishment_last_count,
            'transaction_type' => 3,
            'transaction_date' => $finDate
          ];
          $this->db->table('replenishment')
          ->insert($data); 
          $this->db->table('inventory_transaction')
          ->insert($trans);
        }

        // echo json_encode($data);
        // // for($x = 0; $x <= count($data); $x++){

        // // }
          
    
  }


  function addMem($data){
    $this->db->table("members")
             ->insert($data);
  }
}