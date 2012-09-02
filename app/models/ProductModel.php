<?php
class ProductModel extends BaseModel
{
    static  $instance;
    private $validationErrors = array();

    public static function getInstance()
    {
        if(self::$instance == null)
        {
            self::$instance = new self();
        }

        return self::$instance;
    }
    
    public function getValidationErrors()
    {
        return $this->validationErrors;
    }
}