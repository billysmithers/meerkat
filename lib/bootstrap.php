<?php
    //add the library to our include path
    set_include_path(implode(PS, array(
        ROOT . DS . 'lib',
        get_include_path(),
    )));

    require_once('Router.php');
    require_once('Registry.php');
    require_once('Debug.php');
    require_once('Template.php');
    require_once('Zend' . DS . 'Db.php');
    require_once('models' . DS . 'BaseModel.php');
    require_once(ROOT . DS . 'app'    . DS . 'config' . DS . 'config.php');

    Debug::init();

    $router = new Router();
    $registry = new Registry();
    $registry->template = new Template();
    
    if (!defined('WEBROOT'))
    {
        define('WEBROOT','/');
    }

    if ($db)
    {
        BaseModel::setDb($db);
    }

    $router->route($registry);

    /*** auto load model classes ***/
    function __autoload($className)
    {
        try
        {
            $fileName = $className . '.php';
            $file     = ROOT . DS . 'app' . DS . 'models' . DS . $fileName;

            if (file_exists($file))
            {
                include($file);
            }
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
            exit(0);
        }
    }