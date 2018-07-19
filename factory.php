<?php

namespace parse;
class BaseParse
{
    /**
     * @var string|string
     */
    public static $FileType = "";
    /**
     * @var string|string
     */
    static $getFileString = NULL;

    static $parseConfig = "";

    /**
     * BaseParse constructor.
     * @param string $type
     * @param string $getFileString
     */
    public function __construct(string $getFileString = NULL, array $type = [])
    {
        self::$FileType = $type;
        if (is_null($getFileString)) {
            exit('не выбран файл для парсинга');//            throw new Exception ('не выбран файл для парсинга');
        }
        self::$getFileString = $getFileString;

    }

    /**
     * @return Parser
     */
    Public function Parse()
    {
        if (gettype(self::$FileType["type"]) !== 'string' && (self::$FileType["type"] != 'csv' || self::$FileType["type"] != 'xml')) {
            throw new Exception ('не верно задан тип файла');
        }
        $className = 'Parse\Parse' . ucfirst(self::$FileType["type"]);
        if (class_exists($className)) {
            return new $className(self::$getFileString);
        } else {
            exit('Не найден тип файла.');
            throw new Exception('Не найден тип файла.');
        }
    }

}

?>