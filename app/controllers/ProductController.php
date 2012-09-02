<?php
class ProductController extends BaseController
{
    private $uses = array(
        'ProductModel',
    );
    private $data = array();
    
    function __construct($registry)
    {
        $this->registry = $registry;
        
        foreach ($this->uses as $use)
        {
            $this->$use = $use::getInstance(); 
        }
    }
    
    public function setData($data)
    {
        $this->data = $data;
    }
    
    public function index()
    {
        $this->registry->template->errors = array();
        
        $this->registry->template->products = array();

        if ($this->data)
        {
        }
        
        $this->registry->template->show('productView.php');
    }
}