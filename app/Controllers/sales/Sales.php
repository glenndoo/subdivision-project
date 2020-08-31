<?php namespace App\Controllers\sales;

use App\Controllers\BaseController;
use App\Models\CustomModel;

class Sales extends BaseController{


  public function index(){
               $data = [
      'meta-title' => '',
      'title' => 'Sales',
    ];
    
    $data['name'] = $this->request->getGet('name');
    $data['id'] = $this->request->getGet('id');
    $db = db_connect();
    $model = new CustomModel($db);
    
    $data['sales'] = $model->showSearchDate($data);
    
    if(session()->get('access') == 1){
      return view('sales/viewAll', $data);
    }else{
      return view('clerk/clerkView', $data);
    }
    
}

public function jsonSales(){
    $data['now'] = date("yy-m-d");
    $db = db_connect();
    $model = new CustomModel($db);
    
    $data['sales'] = $model->showAllSales($data);
    
    return $data['sales'];
}

   public function searchSales(){
       $data = [
      'meta-title' => '',
      'title' => 'Sales',
    ];
    $db = db_connect();
    $model = new CustomModel($db);
    
    return view('sales/sales', $data);
   }
   
   public function showMembers(){
          $data = [
      'meta-title' => '',
      'title' => 'Members',
    ];
    $db = db_connect();
    $model = new CustomModel($db);
    $data['members'] = $model->showMembers();
    
    if(session()->get('access') == 1){
      return view('sales/members', $data);
    }else{
      return view('clerk/memberCredit', $data);
    }
    
   }
   
   public function memberPurchases(){
             $data = [
      'meta-title' => '',
      'title' => 'Member Details',
    ];
    $db = db_connect();
    $model = new CustomModel($db);
    $userId = $this->request->getGet('id');
    $data['userId'] = $userId;
    $data['name'] = $this->request->getGet('name');
    $data['members'] = $model->showMemberDetails($userId);
    
    return view('sales/memberDetails', $data);
   
   }
   
   public function searchByMemberDate(){
                $data = [
      'meta-title' => '',
      'title' => 'Member Details',
    ];
                $dates = [ 
                    'now' => $this->request->getGet('selectedMonth'),
                    'id' => $this->request->getGet('id')
                ];
                $data['name'] = $this->request->getGet('name');
                $data['userId'] = $this->request->getGet('id');
                $db = db_connect();
                $model = new CustomModel($db);
                $data['members'] = $model->showMemberDate($dates);
                
                return view('sales/memberDetails', $data);
   }
   
   
   public function makePayment(){

    $data = [
        'sales_member_id' => $this->request->getVar('id'),
        'sales_amount_paid' => $this->request->getVar('payment'),
        'sales_payment_type' => "Cash",
        'sales_item' => 1213,
        'sales_quantity' => 1,
        'sales_by' => session()->get('id'),

    ];

    $db = db_connect();
    $pay = new CustomModel($db);
    $res = $pay->makePayment($data);
    return redirect()->to('/showMembers');
   }
   }
