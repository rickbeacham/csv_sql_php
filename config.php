<?php
/**
 * Created by JetBrains PhpStorm.
 * User: rick
 * Date: 6/24/13
 * Time: 8:00 PM
 */


class config
{
    protected  $host;
    protected $user;
    protected $password;
    protected $dbname;

    public function  __construct()
    {
        $this->host = 'localhost';
        $this->password = '';
        $this->user = 'root';
        $this->dbname = 'corporate';
    }
}
