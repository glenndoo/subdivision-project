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
        $data['info'] = $search->showAll();
        
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
        helper('form');
            $item = $this->request->getGet('id');
    $data = [
            'meta-title' => '',
            'title' => 'Order'
        ];
    $db = db_connect();
        $model = new CustomModel($db);
        $data['info'] = $model->purchaseItem($item); 
        if($this->request->getMethod() == 'post'){
			$rules = [
				'quantity' => [
                                    'rules' => 'required|min_length[1]|max_length[4]|validateQuantity[quantity,stock]',
                                    'label' => 'Quantity',
                                    'errors' => [
                                                    'validateQuantity' => 'Quantity is less than stock'
						]
                                 ],
				'amount' => [
                                    'rules' =>'required|min_length[1]|max_length[4]|validatePrice[amount,stock,price]',
                                    'label' => 'Amount',
                                    'errors' => [
                                                    'validatePrice' => 'Amount to be paid less than total amount'
						]
                                ]
                            
			];
                        
			if(! $this->validate($rules)){
				$data['validation'] = $this->validator;
			}else{
                            $totalAmount = $this->request->getVar('quantity') * $this->request->getVar('price');
                            $items = [
                                'sales_item' => $this->request->getGet('id'),
                                'sales_quantity' => $this->request->getVar('quantity'),
                                'sales_by' => session()->get('id'),
                                'sales_amount_paid' => $this->request->getVar('total'),
                                'sales_total_amount' =>  $totalAmount,
                                'sales_member_id' => $this->request->getVar('member'),
                                'sales_payment_type' => $this->request->getVar('paymentType'),
                                'sales_credit_amount' => $totalAmount
                            ];
                            if($items['sales_payment_type'] == "cash"){
                                $stock = $this->request->getVar('stock') - $items['sales_quantity'];
                                $items['sales_credit_amount'] = 0;
                            $db = db_connect();
                                $model = new CustomModel($db);
                                $model->placeOrder($items, $stock);
                                $session = session();
                                                        $session->setFlashData('success', 'Order placed!');
                                                        return redirect()->to('/clerk');
                            }else{
                                $stock = $this->request->getVar('stock') - $items['sales_quantity'];
                                $items['sales_amount_paid'] = 0;
                                $model = new CustomModel($db);
                                $model->placeOrder($items, $stock);
                                $session = session();
                                                        $session->setFlashData('success', 'Order placed!');
                                                        return redirect()->to('/clerk');
                            }
                            
                            
   
			}
		}
       return view('clerk/order', $data);
    }
    
    
    function jsonData(){
        $db = db_connect();
        $search  = new CustomModel($db);
        $data = $search->json();
        
        return $data;
    }
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

