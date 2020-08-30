<?php  namespace App\Controllers\Inventory;

use App\Controllers\BaseController;
use App\Models\CustomModel;


class Inventory extends BaseController{
    public function index(){
        $data = [
                'meta-title' => '',
                'title' => 'Inventory',
        ];

        
        return view('inventory/inventory', $data);
                
    }
    
    function addItem(){
        helper('form');
         $data = [
                'meta-title' => '',
                'title' => 'Add Item',
        ];
        $db = db_connect();
        $search  = new CustomModel($db);
        $data['info'] = $search->showAll();
        
        if($this->request->getMethod() == 'post'){
			$rules = [
				'itemcode' => 'required|min_length[3]|max_length[15]',
				'itemname' => 'required|min_length[3]|max_length[255]',
                                'category' => 'required',
				'quantity' => 'required|min_length[1]|max_length[4]',
			];



			if(! $this->validate($rules)){
				$data['validation'] = $this->validator;
			}else{
                            $db = db_connect();
				$model = new CustomModel($db);
				$newData = [
					'item_code' => $this->request->getVar('itemcode'),
					'item_name' => $this->request->getVar('itemname'),
					'item_type' => $this->request->getVar('category'),
                                        'item_quantity' => $this->request->getVar('quantity'),
                                        'item_price' => $this->request->getVar('price'),
					'item_added_by' => session()->get('id')
				];
				$model->saveItem($newData);
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
            "item_prev_count" => $this->request->getVar('quantitycount'),
            "item_added_qty" => $this->request->getVar('updatedquantity')
        ];
        
        $updated = [
            "item_code" => $this->request->getGet('id'),
            "item_quantity" => $this->request->getVar('updatedquantity') + $this->request->getVar('quantitycount'),
            "item_name" => $this->request->getVar('itemnameupdate'),
            "item_price" => $this->request->getVar('updatedprice'),
            "item_type" => $this->request->getVar('category')
        ];
        $db = db_connect();
	$model = new CustomModel($db);
        $model->updateInventory($data, $updated);
        
        
        return redirect()->to('/inventory');

    }
}