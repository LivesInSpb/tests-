<?php

namespace Parse;
class ParseXml extends BaseParse
{

    /**
     * getting data type; available simple || attribute
     *
     * @var string
     */
    public static $DataType = "simple";
    public $DataString = '';
    /**
     * result array
     * @var array
     */
    public $ResultArray = [];

    /**
     * ParseXml constructor.
     * @param string|NULL $DataType
     */


    public function __construct($FileString)
    {

        if (is_null($FileString)) {
            exit('не выбран файл для парсинга'); //throw new Exception ('не выбран файл для парсинга');
        }
        $this->DataString = $FileString;
        if (!is_null(parent::$FileType) && (parent::$FileType["additional"] == "attribute" || parent::$FileType["additional"] == "simple")) {
            self::$DataType = ucfirst(parent::$FileType["additional"]);
        }
    }

    private function GetParseType(): string
    {
        return "Parse" . self::$DataType;
    }

    private function ParseSimple()
    {

        preg_replace_callback('~<worker>\n(.*?)</worker>~s', function ($res) {
            $this->ResultArray[] = explode("\n", preg_replace_callback('~<(.*)>(.*)</(.*)>~', function ($res) {
                return $res[1] . ';' . $res[2];
            }, $res[1]));
        },
            $this->DataString);
        array_walk($this->ResultArray, function (&$var) {
            array_walk($var, function (&$value) {
                $value = str_getcsv(trim($value), ';');
                $value = $value[1];
            });
        });
        return $this->ResultArray;
    }

    private function ParseAttribute()
    {
        preg_replace_callback('~<worker>\n(.*?)</worker>~s', function ($res) {
            $this->ResultArray[] = explode("\n", preg_replace_callback('~<param name="(.*)">(.*)</param>~', function ($res) {
                return $res[1] . ';' . $res[2];
            }, $res[1]));
        },
            $this->DataString);
        array_walk($this->ResultArray, function (&$var) {
            array_walk($var, function (&$value) {
                $value = str_getcsv(trim($value), ';');
                $value = $value[1];
            });
        });
        return $this->ResultArray;
    }

    public function Parser()
    {
        $function = $this->GetParseType();
        return $this->{$function}();
    }
}

?>