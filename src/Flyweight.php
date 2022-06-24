<?php

namespace App;

class DataType {
    const TYPE_TEXT = "t";
    const TYPE_FUNC = "func";
    const TYPE_NULL = "null";

    private $type;


    public function __construct($type) {
        $this->type = $type;
    }

    static private $typeMap = [];

    static public function getDataType($type)
    {
        if (!array_key_exists($type, self::$typeMap)) {
            self::$typeMap[$type] = new DataType($type);
        }
        return self::$typeMap[$type];
    }
}

class Cell
{
    private $value;
    private $dataType;

    public function __construct(DataType $datatype, $value = "")
    {
        $this->dataType = $datatype;
        $this->value = $value;
    }
}


$beforeMemory = memory_get_usage();

for ($i=0; $i < 65535 * 256; $i++) { 
    //$cells[$i] = new Cell(new DataType(DataType::TYPE_NULL));
    $cells[$i] = new Cell(DataType::getDataType(DataType::TYPE_NULL));
}

echo "Memory usage: ".number_format((memory_get_usage() - $beforeMemory)/(1024*1024), 0). " MB".PHP_EOL;