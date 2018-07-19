<?php

namespace Parse;
class ParseCsv extends BaseParse
{

    /**
     * result array
     * @var array
     */
    public $ResultArray = [];
    /**
     * @var string
     */
    private $delimiter = ";";
    /**
     * file content
     *
     * @var array
     */
    static $getFileString = [];

    /**
     * ParseXml constructor.
     * @param string|NULL $DataType
     */


    public function __construct($FileString)
    {

        if (is_null($FileString)) {
            exit('не выбран файл для парсинга');//throw new Exception ('не выбран файл для парсинга');
        }
        self::$getFileString = explode("\r\n", $FileString);
        if (gettype(parent::$FileType["additional"]) == 'string') {
            $this->delimiter = parent::$FileType["additional"];
        }
    }


    /**
     * @return Parser
     */
    public function Parser()
    {
        foreach (self::$getFileString as $index => $line) {
            $this->ResultArray[$index] = str_getcsv($line, $this->delimiter);
        }
        return $this->ResultArray;
    }
}

?>