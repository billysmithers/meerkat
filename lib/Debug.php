<?php
class Debug
{
    public static function init()
    {
        $showErrors = 0;

        if (defined('DEBUG_LEVEL'))
        {
            $showErrors = DEBUG_LEVEL;
        }

        error_reporting(E_ALL | E_STRICT);
        ini_set('display_errors',DEBUG_LEVEL);
    }

    public static function output($data)
    {
        if (defined('DEBUG_LEVEL') && DEBUG_LEVEL > 0)
        {
            $backTrace = debug_backtrace();
            
            echo '<pre class="debug">';
            
            echo '<strong>line ' . $backTrace[0]['line'] . ' of file ' . $backTrace[0]['file'] . '</strong>:<br />';
            
            if (is_array($data) || is_object($data))
            {
                print_r($data);
            }
            else
            {
                echo $data;
            }
            
            echo '<br />';
            
            if (DEBUG_LEVEL > 1)
            {
                debug_print_backtrace();
            }
            
            echo '</pre>';
        }
    }

    public static function log($data)
    {
        if (defined('DEBUG_LEVEL') && DEBUG_LEVEL > 0)
        {
            if (is_array($data) || is_object($data))
            {
                error_log(print_r($data,1));
            }
            else
            {
                error_log($data);
            }
        }
    }
}