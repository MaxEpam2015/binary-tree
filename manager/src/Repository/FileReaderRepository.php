<?php

namespace App\Repository;

use App\Repository\Contracts\FileReaderRepositoryInterface;
use App\Facade\BinaryTreeFacade;
use Exception;

class FileReaderRepository implements FileReaderRepositoryInterface
{
    static $fileName = 'binary-tree.json';

    /**
     * @return mixed|string
     */
    public function getFile()
    {
        try {
            $jsonString = file_get_contents(self::$fileName);
            $jsonDecodeTree = json_decode($jsonString, true);
            return $jsonDecodeTree;
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function setDataToFile(BinaryTreeFacade $tree)
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