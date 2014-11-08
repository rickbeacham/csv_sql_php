<?php
/**
 * Created by JetBrains PhpStorm.
 * User: rick
 * Date: 6/24/13
 * Time: 7:36 PM
 */

require_once 'dbConnection.php';
$db = new dbConnection();
if(isset($_POST) && !empty($_POST) && $_POST['frmSubmit'] == 'Submit')
{
    //validate the post varibales
    unset($_POST['frmSubmit']);
    $validate =  true;
    $errorMsg = array();
    if(empty($_POST['storeName']))
    {
        $validate = false;
        $errorMsg['storeName'] = 'Store Name Could not be blank';
    }
    if(empty($_POST['storeAddress']))
    {
        $validate = false;
        $errorMsg['storeAddress'] = 'Store Address Could not be blank';
    }
    if(empty($_POST['pickDate']))
    {
        $validate = false;
        $errorMsg['pickDate'] = 'Select a Date';
    }

    if($validate)
    {
        //save the details
        $insertArray = array(
            'storename'    => $_POST['storeName'],
            'storeaddress' => $_POST['storeAddress'],
            'pickdate'     => $_POST['pickDate']
        );
        $db->insert($insertArray, 'storedetails');
        header( 'Location: success.php' ) ;
    }
    else{
        //print_r($errorMsg);die;
        header( 'Location: index.php' ) ;
        //renderPhpToString('index.php');
    }


}

function renderPhpToString($file, $vars=null)
{
    if (is_array($vars) && !empty($vars)) {
        extract($vars);
    }
    ob_start();
    include $file;
    //return ob_get_clean();
}