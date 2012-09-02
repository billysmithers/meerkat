<?php
class Router
{
    private $path, $controller, $action;
    static  $instance;

    public function __construct()
    {
        $request = '/';

        if (isset($_GET['request']))
        {
            $request = $_GET['request'];
        }

        $split = explode('/',trim($request,'/'));

        $this->controller = !empty($split[0]) ? ucfirst($split[0]) : 'Index';
        $this->action     = !empty($split[1]) ? $split[1] : 'index';
        
        if (file_exists(ROOT . DS . 'app' . DS . 'routing' . DS . 'customRouting.php'))
        {
            include(ROOT . DS . 'app' . DS . 'routing' . DS . 'customRouting.php');
            
            if (isset($customRoutes[$this->controller]))
            {
                $this->controller = ucfirst($customRoutes[$this->controller]);
            }
        }
    }

    public function route($registry)
    {
        require_once('controllers' . DS . 'BaseController.php');

        $file = ROOT . DS . 'app' . DS . 'controllers' . DS . $this->controller . 'Controller.php';

        if(is_readable($file))
        {
            include($file);

            $class = $this->controller . 'Controller';
        }
        else
        {
            include('controllers' . DS . 'Error404Controller.php');

            $class = 'Error404Controller';
        }

        $controller = new $class($registry);

        if (is_callable(array($controller, $this->action)))
        {
            $action = $this->action;
        }
        else
        {
            $action = 'index';
        }
        
        $controller->setData($_POST);

        $controller->$action();
    }
}
?>