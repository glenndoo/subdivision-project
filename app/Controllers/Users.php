<?php namespace App\Controllers;

use App\Models\CustomModel;

class Users extends BaseController
{
	public function index()
	{
		helper(['form']);
		$data = [
			'meta-title' => '',
			'title' => 'Login',
		];

		if($this->request->getMethod() == 'post'){
			$rules = [
				'username' => 'required|min_length[3]|max_length[15]',
				'password' => 'required|min_length[8]|max_length[255]|validateUser[username,password]'
			];

			$errors = [
				'password' => [
					'validateUser' => 'Email or Password is incorrect'
				]
			];


			if(! $this->validate($rules, $errors)){
				$data['validation'] = $this->validator;
			}else{
				$db = db_connect();
				$model = new CustomModel($db);
				$user = $this->request->getVar('username');
				$use = $model->model($user);
                                $login['tracker_user_id'] = $use['id'];
                                $login['tracker_status'] = 'in';
                                $model->loginTrack($login);
				$this->setUserMethod($use);
				return redirect()->to('/Dashboard');
			}
		}

		echo view('Users', $data);
	}

	public function register(){
		helper(['form']);
		$data = [
			'meta-title' => '',
			'title' => 'Register'
		];

		if($this->request->getMethod() == 'post'){
			$rules = [
				'firstname' => 'required|min_length[3]|max_length[20]',
				'lastname' => 'required|min_length[3]|max_length[20]',
				'username' => 'required|min_length[3]|max_length[15]|is_unique[users.user_login]',
				'password' => 'required|min_length[8]|max_length[255]',
				'passwordcon' => 'matches[password]'
			];

			if(! $this->validate($rules)){
				$data['validation'] = $this->validator;
			}else{
				$db = db_connect();
				$model = new CustomModel($db);
				$hashPass = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
				$newData = [
					'user_first' => $this->request->getVar('firstname'),
					'user_last' => $this->request->getVar('lastname'),
					'user_login' => $this->request->getVar('username'),
					'password' => $hashPass,
					'user_access' => $this->request->getVar('access')
				];
				$model->save($newData);
				$session = session();
				$session->setFlashData('success', 'Account Created! You may now login');
				return redirect()->to('/');
			}
		}

		echo view('register', $data);
	}


	private function setUserMethod($user){

				$data = [
					'first' => $user['first'],
					'last' => $user['last'],
					'login' => $user['login'],
                    'id' => $user['id'],
					'isLoggedIn' => true,
					'access' => $user['access']
				];

				session()->set($data);
				return true;
	}

	public function profile(){

			helper(['form']);
			$db = db_connect();
			$model = new CustomModel($db);
			$str = strval(session()->get('login'));
			$getDetails = $model->model($str);
			$data = [
			 'meta-title' => '',
			 'title' => 'Profile',
			 'fname' => $getDetails['first'],
			 'lname' => $getDetails['last'],
			 'lgn' => $getDetails['login'],
			];



			if($this->request->getMethod() == 'post'){
				$rules = [
					'firstname' => 'required|min_length[3]|max_length[20]',
					'lastname' => 'required|min_length[3]|max_length[20]',
					'username' => 'required|min_length[3]|max_length[15]|is_unique[users.user_login]',
				];

				if(! $this->validate($rules)){
					$data['validation'] = $this->validator;

					$db = db_connect();
					$model = new CustomModel($db);
					$user = [
						'user_first' => $this->request->getPost('firstname'),
						'user_last' => $this->request->getPost('lastname'),
						'user_login' => $this->request->getPost('username'),
					];
					$session = session()->get('login');
					$status = $model->update($user, $session);

						$session = session();
						$data = [
							'first' => $this->request->getPost('firstname'),
							'last' => $this->request->getPost('lastname'),
							'login' => $this->request->getPost('username'),
							'isLoggedIn' => true,
						];

						session()->set($data);
						$session->setFlashData('success', 'Account Updated!');
						return redirect()->to('/profile');

				}
			}
			$data['user'] = session()->get('login');
			echo view('profile', $data);



	}

	function logout(){
            $db = db_connect();
            $model = new CustomModel($db);
            $data = [
                'tracker_user_id' => session()->get('id'),
                'tracker_status' => 'out'
            ];
            
            $model->logout($data);
		session();
		session_destroy();
		return redirect()->to('/');
	}
        
        function datatable(){
            return view('inventory/datatable');
        }
}
