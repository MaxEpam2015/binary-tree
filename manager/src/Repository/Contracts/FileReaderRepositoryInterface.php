<?php

namespace App\Repository\Contracts;

use App\Facade\BinaryTreeFacade;

interface FileReaderRepositoryInterface
{
    public function getFile();

    /**
     * @return mixed
     */
    public function setDataToFile(BinaryTreeFacade $tree);
}