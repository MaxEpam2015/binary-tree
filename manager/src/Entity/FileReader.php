<?php

namespace App\Entity;

use App\Repository\BinarySearchTreeRepository;
use Exception;

trait FileReader
{
    public static function getFile()
    {
        try {
            $jsonString = file_get_contents('binary-tree.json');
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

            $fp = fopen('binary-tree.json', 'w');
            fwrite($fp, $jsonData);
            fclose($fp);
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }
}