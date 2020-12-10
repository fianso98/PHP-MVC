<?php 

    //Core src class
    class Core{
        //default controller (defaul page)
        protected $currentController ='Users';
        //default method
        protected $currentMethod = 'index';
        protected $params =[];

        public function __construct(){
            //get Url
            $url = $this->getUrl();
            //check if the controller exists
            if(file_exists('../app/Controllers/'.ucwords($url[0]).'.php')){
                    $this->currentController= ucwords($url[0]);
                    unset($url[0]);
            }

            //Require the controller
            require_once '../app/Controllers/'.$this->currentController.'.php';
            $this->currentController = new $this->currentController;
            //if the url has a second parameters then
            if(isset($url[1])){
                //check if the controller has that method
                if(method_exists($this->currentController, $url[1])){
                    $this->currentMethod = $url[1];
                    unset($url[1]);
                }
            }

            //get params
            $this->params = $url ? array_values($url) : [];

            //call a callback with array of params
            call_user_func_array([$this->currentController, $this->currentMethod],$this->params);
        }

        public function getUrl(){
            if(isset($_GET['url'])){

                $url = rtrim($_GET['url'], '/');
                
                $url = filter_var($url,FILTER_SANITIZE_URL);
                
                $url = explode('/',$url);
                return $url;
            }
        }
    }