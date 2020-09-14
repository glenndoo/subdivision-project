<?php namespace App\Controllers\clerk;

use App\Controllers\BaseController;
use App\Models\CustomModel;

class Clerk extends BaseController{
    public function index(){
        $data = [
            'meta-title' => '',
            'title' => 'Clerk'
        ];
        
        $db = db_connect();
        $search  = new CustomModel($db);
        $data['smart'] = $search->showSmart();
        $data['globe'] = $search->showGlobe();
        $data['members'] = $search->showMemberOrder();
        $data['cart'] = $search->jsonCart();




        
        return view('clerk/clerk', $data);
    }
    
    public function search(){
        $data = [
            'meta-title' => '',
            'title' => 'Clerk'
        ];
        
        $item = $this->request->getGet('item');
        $db = db_connect();
        $model = new CustomModel($db);
        $data['info'] = $model->searchItem($item);
        
        if($data['info']){
            return view('clerk/clerk', $data);
        }else{
            return view('clerk/clerk', $data);
        }
        

    }

    public function Order(){
    helper('form');
    $item = $this->request->getGet('id');
    $data = [
            'meta-title' => '',
            'title' => 'Order'
        ];
    $db = db_connect();
        $model = new CustomModel($db);
        $data['info'] = $model->purchaseItem($item);   
        $data['members'] = $model->showMemberOrder();
                 return view('clerk/order', $data);
    }
    
    public function purchase(){
            $item = $this->request->getGet('id');
    $data = [
            'meta-title' => '',
            'title' => 'Order'
        ];

        
        if($this->request->getMethod() == 'post'){
			$member = $this->request->getVar("member[]");
            $code = $this->request->getVar("code[]");
            $quantity = $this->request->getVar("quantity[]");
            $price = $this->request->getVar("price[]");
            $paymentType = $this->request->getVar('paymentType');
            $total = $this->request->getVar("total[]");
            $stock = $this->request->getVar("stock[]");
            $current = $this->request->getVar("current[]");
            $items = array();
            $transaction = array();
            $inv = array();

            if($paymentType == "cash"){
                for($i = 0; $i < count($member); $i++){
                    $items[$i] = array(
                    'sales_item' => $code[$i],
                    'sales_quantity' => $quantity[$i],
                    'sales_by' => session()->get('id'),
                    'sales_amount_paid' => $total[$i],
                    'sales_total_amount' => $quantity[$i]*$price[$i],
                    'sales_member_id' => $member[$i],                   
                    'sales_payment_type' => $paymentType,
                    'sales_credit_amount' => 0, 
                    );

                    $transaction[$i]  = array(
                        'item_code' => $code[$i],
                        'item_added_qty' => $quantity[$i]*-1,
                        'item_prev_count' => $current[$i],
                        'item_current_count' => $current[$i]-$quantity[$i],
                        'transaction_type' => 1,
                        'transaction_by' => session()->get('id')
                    );
                    $inv[$i]  = array(
                        'item_id' => $code[$i],
                        'item_quantity' => $current[$i]-$quantity[$i]
                    );
                }
                    $db = db_connect();
                                $model = new CustomModel($db);
                                $model->tryOrder($items,$transaction,$inv);
                                $session = session();
                                $session->setFlashData('success', 'Order placed!');
                                return redirect()->to('/clerk');
            }else{
                for($i = 0; $i < count($member); $i++){
                    $items[$i] = array(
                        'sales_item' => $code[$i],
                        'sales_quantity' => $quantity[$i],
                        'sales_by' => session()->get('id'),
                        'sales_total_amount' => $total[$i],
                        'sales_amount_paid' => 0,
                        'sales_member_id' => $member[$i],                   
                        'sales_payment_type' => $paymentType,
                        'sales_credit_amount' => $quantity[$i]*$price[$i], 
                    );
                    $transaction[$i]  = array(
                        'item_code' => $code[$i],
                        'item_added_qty' => $quantity[$i]*-1,
                        'item_prev_count' => $current[$i],
                        'item_current_count' => $current[$i]-$quantity[$i],
                        'transaction_type' => 1,
                        'transaction_by' => session()->get('id')
                    );
                    $inv[$i]  = array(
                        'item_id' => $code[$i],
                        'item_quantity' => $current[$i]-$quantity[$i]
                    );

                    
                }
                $db = db_connect();
                                $model = new CustomModel($db);
                                $model->tryOrder($items,$transaction,$inv);
                                $session = session();
                                $session->setFlashData('success', 'Order placed!');
                                return redirect()->to('/clerk');
            }
                            // $totalAmount = $this->request->getVar('quantity') * $this->request->getVar('price');
                            // $items = [
                            //     'sales_item' => $this->request->getGet('id'),
                            //     'sales_quantity' => $this->request->getVar('quantity'),
                            //     'sales_by' => session()->get('id'),
                            //     'sales_amount_paid' => $this->request->getVar('total'),
                            //     'sales_total_amount' =>  $totalAmount,
                            //     'sales_member_id' => $this->request->getVar('member'),
                            //     'sales_payment_type' => $this->request->getVar('paymentType'),
                            //     'sales_credit_amount' => $totalAmount
                            // ];
                            // if($items['sales_payment_type'] == "cash"){
                            //     $stock = $this->request->getVar('stock') - $items['sales_quantity'];
                            //     $current = $this->request->getVar('stock');
                            //     $items['sales_credit_amount'] = 0;
                                // $db = db_connect();
                                // $model = new CustomModel($db);
                                // $model->placeOrder($items, $stock, $current);
                                // $session = session();
                                //                         $session->setFlashData('success', 'Order placed!');
                                //                         return redirect()->to('/clerk');
                            // }else{
                            //     $stock = $this->request->getVar('stock') - $items['sales_quantity'];
                            //     $current = $this->request->getVar('stock');
                            //     $items['sales_amount_paid'] = 0;
                            //     $model = new CustomModel($db);
                            //     $model->placeOrder($items, $stock, $current);
                            //     $session = session();
                            //                             $session->setFlashData('success', 'Order placed!');
                            //                             return redirect()->to('/clerk');
                            // }
                            
                            
   
			
		}
    //    return view('clerk/order', $data);
    }
    
    
    function jsonData(){
        $db = db_connect();
        $search  = new CustomModel($db);
        $data = $search->json();
        
        return $data;
    }


    function cart(){
        $data = [
            'member_id' => $this->request->getGet("member"),
            'item_code' => $this->request->getGet("id")
        ];
        $db = db_connect();
        $search  = new CustomModel($db);
        $data = $search->cart($data);
        return redirect()->to("clerk");
    }


    function placeOrder (){
            $member = $this->request->getVar("member[]");
            $price = $this->request->getVar("code[]");
            $quantity = $this->request->getVar("quantity[]");

            $values = array();

            for($i = 0; $i < count($member); $i++){
                $values[$i] = array(
                    'member_id' => $member[$i],
                    'item_code' => $quantity[$i]
                );
            }
        $db = db_connect();
        $search  = new CustomModel($db);
        $data = $search->cart($values);
        return redirect()->to("clerk");
        }
    


    function globeLoad(){
    $type = $this->request->getVar("loadType");
    if($type == "cash"){
        $data = [
            'sales_item' => $this->request->getVar("loadCode"),
            'sales_quantity' => $this->request->getVar("loadActual"),
            'sales_by' => session()->get('id'),
            'sales_amount_paid' => $this->request->getVar("loadTotal"),
            'sales_total_amount' => $this->request->getVar("loadTotal"),
            'sales_member_id' => $this->request->getVar("loadMember"),                   
            'sales_payment_type' => $this->request->getVar("loadType"),
            'sales_credit_amount' => 0, 
        ];

        $transact = [
            'item_code' => $this->request->getVar("loadCode"),
            'item_added_qty' => $this->request->getVar("loadActual")*-1,
            'item_prev_count' => $this->request->getVar("loadStock"),
            'item_current_count' => $this->request->getVar("loadStock")-$this->request->getVar("loadActual"),
            'transaction_type' => 1,
            'transaction_by' => session()->get('id')
        ];

        $inventory = [
            'item_id' => $this->request->getVar("loadCode"),
            'item_quantity' => $this->request->getVar("loadStock")-$this->request->getVar("loadActual")
        ];
        
        $db = db_connect();
        $model = new CustomModel($db);
        $model->placeOrder($data,$transact,$inventory);
        $session = session();
        $session->setFlashData('success', 'Order placed!');
        return redirect()->to('/clerk');      
        


    }else{
        $data = [
            'sales_item' => $this->request->getVar("loadCode"),
            'sales_quantity' => $this->request->getVar("loadActual"),
            'sales_by' => session()->get('id'),
            'sales_amount_paid' => 0,
            'sales_total_amount' => $this->request->getVar("loadTotal"),
            'sales_member_id' => $this->request->getVar("loadMember"),                   
            'sales_payment_type' => $this->request->getVar("loadType"),
            'sales_credit_amount' => $this->request->getVar("loadTotal"), 
        ];

        $transact = [
            'item_code' => $this->request->getVar("loadCode"),
            'item_added_qty' => $this->request->getVar("loadActual")*-1,
            'item_prev_count' => $this->request->getVar("loadStock"),
            'item_current_count' => $this->request->getVar("loadStock")-$this->request->getVar("loadActual"),
            'transaction_type' => 1,
            'transaction_by' => session()->get('id')
        ];

        $inventory = [
            'item_id' => $this->request->getVar("loadCode"),
            'item_quantity' => $this->request->getVar("loadStock")-$this->request->getVar("loadActual")
        ];


        $db = db_connect();
        $model = new CustomModel($db);
        $model->placeOrder($data,$transact,$inventory);
        $session = session();
        $session->setFlashData('success', 'Order placed!');
        return redirect()->to('/clerk'); 
    }
        
        
    }       
    
    
    
            
            
         
    
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

