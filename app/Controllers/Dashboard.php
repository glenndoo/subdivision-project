<?php namespace App\Controllers;

use App\Models\CustomModel;

class Dashboard extends BaseController{
  public function index(){
    $data = [
			'meta-title' => '',
			'title' => 'Dashboard',
		];
    

    
    return view('dashboard', $data);
}

    public function loginRec(){
            $db = db_connect();
    $model = new CustomModel($db);
    $data['user'] = session()->get('id');
    
    $data['details'] = $model->loginDetails($data);
    
    return $data['details'];
    }
}


