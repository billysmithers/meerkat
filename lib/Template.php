<?php
class Template
{
    private $content;
    private $view;
    private $vars = array();

    public function __set($index, $value)
    {
        $this->vars[$index] = $value;
    }

    public function show($viewName)
    {
        try
        {
            $this->view = $viewName;
            
            //This should probably be more dynamic to allow for
            //multiple layouts and also to specify which layout to load
            $layout  = ROOT . DS . 'app' . DS . 'layouts' . DS . 'layout.phtml';

            if (!file_exists($layout))
            {
                $layout = ROOT . DS . 'lib' . DS . 'layouts' . DS . 'defaultLayout.phtml';

                if (!file_exists($layout))
                {
                    throw new Exception('Layout not found.');
                }
            }

            //we only want to set the content from within this function
            //so we do not have a public setter
            $this->content = ROOT . DS . 'app' . DS .'views' . DS . $this->view;

            include($layout);
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
            exit(0);
        }
    }
    
    public function getWebroot()
    {
        return WEBROOT;
    }

    public function getContent()
    {
        if ($this->content)
        {
            if (!file_exists($this->content))
            {
                $this->content = ROOT . DS . 'lib' . DS . 'views' . DS . $this->view;

                if (!file_exists($this->content))
                {
                    throw new Exception('View ' . $this->view . ' not found.');
                }
            }
            else
            {
                foreach ($this->vars as $key => $value)
                {
                    $$key = $value;
                }
            }

            include($this->content);
        }
    }
}