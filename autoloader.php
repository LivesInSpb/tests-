<?php

namespace BASE;
final class autoloader
{
    const documentRoot = __DIR__;
    function __construct()
    {
    }

    /**
     * autoload classes
     *
     * @param array $ClassList
     * @return bool
     */
    public static function includeClass($ClassList = [])
    {
        if (empty($ClassList) || gettype($ClassList) != 'array') {
            exit('не корректные настройки классов'); // throw new Exception ('не корректные настройки классов');
        }
        foreach ($ClassList as $ClassName){
            if (file_exists(self::documentRoot . "/" . $ClassName .'.php')) {
                require_once(self::documentRoot . "/" . $ClassName .'.php');
            }
        }
    }
}

?>