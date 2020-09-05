<?php namespace App\Controllers\Clerk;
use App\Controllers\BaseController;

class tryMe extends BaseController{
    public function __construct(){
        parent::__construct();
    }

    public function index(){
        $this->load->library("cart");
    }
}