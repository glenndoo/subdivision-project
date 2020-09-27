<?php  namespace App\Controllers\Inventory;

use App\Controllers\BaseController;
use App\Models\CustomModel;


class Inventory extends BaseController{
    public function index(){
        $data = [
                'meta-title' => '',
                'title' => 'Inventory',
        ];

        if($this->request->getGet("dateSelected") == null){
            $data['dateNow'] = date("yy-m-d");
          }else if(strlen($this->request->getGet("dateSelected")) == 10){
            $data['dateNow'] = $this->request->getGet("dateSelected");
          }else if(strlen($this->request->getGet("dateSelected")) == 7){
            $data['dateNow'] = substr($data['dateNow'] = $this->request->getGet("dateSelected"), -2);
            $data['month'] = $data['dateNow'];
          }else{
          }
        
        return view('inventory/inventory', $data);
                
    }
    
    function addItem(){
        helper('form');
         $data = [
                'meta-title' => '',
                'title' => 'Add Item',
        ];
        
        if($this->request->getMethod() == 'post'){
			$rules = [
				'itemname' => 'required|min_length[3]|max_length[255]',
				'quantity' => 'required|min_length[1]|max_length[4]',
			];



			if(! $this->validate($rules)){
				$data['validation'] = $this->validator;
			}else{
                            $db = db_connect();
				$model = new CustomModel($db);
				$newData = [
                    'item_name' => $this->request->getVar('itemname'),
                    'item_quantity' => $this->request->getVar('quantity'),
                    'item_price' => $this->request->getVar('sellingPrice'),
                    'item_unit_price' => $this->request->getVar('unitPrice'),
					'item_added_by' => session()->get('id')
                ];
                
                $transaction = [
                    'item_old_price' => $this->request->getVar('unitPrice'),
                    'item_marked_up' => $this->request->getVar('sellingPrice'),
                    'item_prev_count' => $this->request->getVar('quantity'),
                    'item_added_qty' => $this->request->getVar('quantity'),
                    'item_current_count' => $this->request->getVar('quantity'),
                    'transaction_by' => session()->get('id')

                ];
				$model->saveItem($newData,$transaction);
				$session = session();
				$session->setFlashData('success', 'Item Added!');
				return redirect()->to('addItem');
			}
		}
        return view('inventory/inventory', $data);
    }
    
    
    function removeItem(){
        $id = $this->request->getGet('id');
        $db = db_connect();
	    $model = new CustomModel($db);
        $rem = $model->deleteItem($id);
        
        if($rem){
            $session = session();
            $session->setFlashData('remove', 'Item Removed!!');
            return redirect()->to('/inventory');
        }
    }
    function jsonData(){
                $db = db_connect();
            $search  = new CustomModel($db);
            $data['info'] = $search->json();
            
            return $data['info'];
    }

    function updateItem(){
        
        $data = [
            "item_code" => $this->request->getGet('id'),
            "item_old_price" => $this->request->getVar('updateUnit'),
            "item_marked_up" => $this->request->getVar('updateSell'),
            "transaction_type" => 1,
            'transaction_by'  => session()->get('id')
        ];

        $updated = [
            "item_code" => $this->request->getGet('id'),
            "item_name" => $this->request->getVar('itemnameupdate'),
            "item_price" => $this->request->getVar('updateSell'),
            "item_unit_price" => $this->request->getVar('updateUnit')
        ];

        $db = db_connect();
	    $model = new CustomModel($db);
        $model->updateInventory($data, $updated);
        
        
        return redirect()->to('/inventory');

    }

    public function inventorySummary(){
        $data = [
            'meta-title' => '',
            'title' => 'Inventory Summary',
          ];
  
          if($this->request->getGet("dateSelected") == null){
            $data['dateNow'] = date("yy-m");
          }else if(strlen($this->request->getGet("dateSelected")) == 10){
            $data['dateNow'] = $this->request->getGet("dateSelected");
          }else if(strlen($this->request->getGet("dateSelected")) == 7){
            $data['dateNow'] = substr($data['dateNow'] = $this->request->getGet("dateSelected"), -2);
            $data['month'] = $data['dateNow'];
          }else{
          }

        return view("inventory/invSum", $data);
    }

    public function jsonInventory(){
        $date = $this->request->getGet("date");
        $db = db_connect();
        $inv = new CustomModel($db);
        $report = $inv->inventoryReport($date);

        return $report;
    }


    public function replenish(){
        // $data = [

        //     'item_code' => $this->request->getVar("replenishItem"),
        //     'item_current_count' => $this->request->getVar("replenishCount") + $this->request->getVar("replenishQty"),
        //     'item_added_qty' =>  $this->request->getVar("replenishQty"),
        //     'item_prev_count' => $this->request->getVar("replenishCount"),
        //     'transaction_by'  => session()->get('id')
        // ];
        // $updated = [

        //     'item_code' => $this->request->getVar("replenishItem"),
        //     'item_quantity' => $this->request->getVar("replenishCount") + $this->request->getVar("replenishQty"),

        // ];

        $data = [
            'replenishment_item' => $this->request->getVar('replenishItem'),
            'replenishment_last_count' => $this->request->getVar('replenishCount')
        ];



        $db = db_connect();
	    $model = new CustomModel($db);
        $model->updateInventory($data);
        
        
        return redirect()->to('/inventory');

    }

    function showSummary(){
        $data = [
            'meta-title' => '',
            'title' => 'Item Summary',
            'id' => $this->request->getVar("id")
        ];
        return view("inventory/itemSummary", $data);
    }
    function invDetails(){
        $itemId = $this->request->getVar("id");
        $db = db_connect();
	    $model = new CustomModel($db);
        $res = $model->itemSummary($itemId);

        return $res;
    }


    function stampInventory(){
        $db = db_connect();
	    $model = new CustomModel($db);
        $res = $model->stampInv();
        $data = [
            'meta-title' => '',
            'title' => 'Inventory Summary',
          ];
  
          if($this->request->getGet("dateSelected") == null){
            $data['dateNow'] = date("yy-m");
          }else if(strlen($this->request->getGet("dateSelected")) == 10){
            $data['dateNow'] = $this->request->getGet("dateSelected");
          }else if(strlen($this->request->getGet("dateSelected")) == 7){
            $data['dateNow'] = substr($data['dateNow'] = $this->request->getGet("dateSelected"), -2);
            $data['month'] = $data['dateNow'];
          }else{
          }

        return view("inventory/invSum", $data);
        // return view("inventory/invSum");
    }
}