<?php
    //Load the model and the view
    class Controller{
        //Load the model
        public function model($model){

            require_once '../app/Models/'.$model.'.php';

            return new $model();
        }
        //Load the view (check the file)
        public function view($view, $data = []){
            if(file_exists('../app/Views/'.$view.'.php')){
                require_once '../app/Views/'.$view.'.php';
            }else{
                die('view does not exists.');
            }

            
        }
    }