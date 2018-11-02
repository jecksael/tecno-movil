<?php

/**
*
*/
class Router
{
    public $url;
    public $controller;
    public $method;
    public $param;

    public function __construct()
    {
        $this->setUrl();
        $this->setController();
        $this->setMethod();
        $this->setParam();
    }

    public function setUrl(){

        $this->url = explode('/', URL);
    }

    public function setController(){
        $this->controller = $this->url[1] === '' ? 'Login' : ucwords($this->url[1]);
    }

    public function setMethod(){
        $this->method = ! empty($this->url[2]) ? $this->url[2] : 'index';
    }

    public function setParam(){
        if(REQUEST_METHOD === 'POST')
          $this->param = $_POST;
        else if (REQUEST_METHOD === 'GET')
          $this->param = ! empty($this->url[3]) ? $this->url[3] : '';

    }

    public function getUrl(){
        return $this->url;
    }

    public function getController(){
        return $this->controller.'Controller';
    }

    public function getMethod(){
        return $this->method;
    }

    public function getParam(){
        return $this->param;
    }
}

?>
