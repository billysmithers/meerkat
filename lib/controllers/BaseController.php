<?php
abstract class BaseController
{
    protected $registry;
    private   $uses = array();
    private   $data = array();

    function __construct($registry)
    {
        $this->registry = $registry;
    }
    
    abstract function setData($data);

    abstract function index();
}