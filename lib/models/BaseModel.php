<?php
class BaseModel extends Zend_Db
{
    static $db;

    public static function setDb($db)
    {
        self::$db = $db;
    }
}