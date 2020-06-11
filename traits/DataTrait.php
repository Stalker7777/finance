<?php

namespace app\traits;

trait DataTrait
{
    abstract function setTestData();
    abstract function findData();
    abstract function loadFindData();
    
    /**
     *
     */
    public function printTestData()
    {
        echo '<pre>';
        var_dump($this->data_array);
        echo '</pre>';
    }
}