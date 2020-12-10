<?php 
class Users extends Controller {
    private $userModel;
    public function __construct(){
        $this->userModel = $this->model('User');
    }
    public function index(){
        $users = $this->userModel->getUsers();

        $data =[
            'users'=> $users
        ];
        $this->view('users/index',$data);
    }
    public function about(){
        $this->view('users/about');
    }
}