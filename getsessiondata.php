<?php
/**
 * Created by JetBrains PhpStorm.
 * User: rbeacham
 * Date: 6/26/13
 * Time: 1:05 PM
 * To change this template use File | Settings | File Templates.
 */

class getsessiondata {


    public $stName;

    public function setProperty($storeName)
    {
        $this->stName = $storeName;
    }

    public function getProperty()
    {
        return $this->stName . "<br />";
    }

}


