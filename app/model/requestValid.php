<?php

class requestValid {
    // Promeny
    public $method;
    
    // Konstruktor
   public function __construct($method = NULL) {
       $this->method = $method;
   }
    // Metody
    public function setMethod($method) 
    {
        $this->method = $method;
    }
    
    public function checkString($data)
    {
        if(!is_string($data)){
            throw new \Exception('Param '.$data.'is not string');
        }
    }
    
    public function checkNumeric($data,$data1 = NULL,$data2 = NULL,$data3 = NULL)
    {
        if(!is_numeric($data)){
            throw new \Exception('Param '.$data.'is not numeric');
        }
        if(!is_numeric($data1) && !is_null($data1)){
            throw new \Exception('Param '.$data1.'is not numeric');
        }
        if(!is_numeric($data2) && !is_null($data2)){
            throw new \Exception('Param '.$data2.'is not numeric');
        }
        if(!is_numeric($data3) && !is_null($data3)){
            throw new \Exception('Param '.$data3.'is not numeric');
        }
    }
    
    public function checkEmpty($data,$data1 = FALSE,$data2 = FALSE,$data3 = FALSE)
    {
        if(is_null($data)){
            throw new \Exception('You miss param');
        }
        if(is_null($data1)){
            throw new \Exception('You miss param');
        }
        if(is_null($data2)){
            throw new \Exception('You miss param');
        }
        if(is_null($data3)){
            throw new \Exception('You miss param');
        }
    }
    
    public function checkName($name)
    {
        if(!self::isName($name)){
            throw new \Exception('Param '.$name.'is not valid');
        }    
    }
    
    public function checkEmail($email)
    {
        if(!self::isEmail($email)){
            throw new \Exception('Param '.$email.'is not email');
        }
    }
    
    public function checkPassword($password)
    {
        if(!self::isPassword($password)){
            throw new \Exception('Param '.$password.'is not password');
        }
    }

    
    public function isName($data) 
    {
        self::checkString($data);
        self::checkEmpty($data);
        return TRUE;
    }    
    
    public function isEmail($data) 
    {
        self::checkString($data);
        self::checkEmpty($data);
        return filter_var($data, FILTER_VALIDATE_EMAIL);
    }
    
    public function isPassword($data) 
    {
        self::checkString($data);
        self::checkEmpty($data);
        return preg_match('/[A-Z]+[a-z]+[0-9]+/', $data);
    }
    
    public function checkRequestParam()
    {
        
    }
    
    public function checkPost(){
        if($this->method != 'POST'){
            throw new \Exception('Wrong method');
        }
    }
}