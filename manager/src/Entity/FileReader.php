<?php

namespace App\Entity;

use App\Repository\BinarySearchTreeRepository;
use Exception;

trait FileReader
{
    static $fileName = 'binary-tree.json';

    public static function getFile()
    {
        try {
            $jsonString = file_get_contents(self::$fileName);
            $jsonDecodeTree = json_decode($jsonString, true);
            return $jsonDecodeTree;
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

    public static function setDataToFile(BinarySearchTreeRepository $tree)
    {
        try {
            $objectToArray = (array)$tree;
            $array = $objectToArray[array_key_first($objectToArray)];

            $jsonData = json_encode($array);

            $fp = fopen(self::$fileName, 'w');
            fwrite($fp, $jsonData);
            fclose($fp);
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }
}