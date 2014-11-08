<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Verification Page</title>
    <link href="styles.css" type="text/css" rel="stylesheet"  />
    <link rel="stylesheet" href="jquery-ui.css" />
    <link href="/templates/gikinew/favicon.ico" rel="shortcut icon" type="image/x-icon" />

    <!-- load jQuery and the plugin -->
    <script src="jquery-1.7.js" type="text/javascript"></script>
    <script src="jquery-ui.js"></script>
    <script src="profile.js" type="text/javascript"></script>

    <script>
        $(function() {
            $( "#pickDate" ).datepicker({
                dateFormat: "yy/mm/dd"
            });

        });

    </script>
</head>




<body>
<?php
session_start();

require_once 'dbConnection.php';
//require_once 'getsessiondata.php';
$db = new dbConnection();

//$sessionData = new getsessiondata();



if(isset($_POST) && !empty($_POST) && $_POST['frmSubmit'] == 'Submit')
{
    $storeName    = $_POST['storeName'];
    $storeAddress = $_POST['storeAddress'];
    $organization = $_POST['organization'];
    $pickDate     = $_POST['pickDate'];

    $_SESSION['storeName'] = $storeName;
    $_SESSION['storeAddress'] = $storeAddress;
    $_SESSION['organization'] = $organization;
    $_SESSION['pickDate'] = $pickDate;
    //echo $storeNme;

    //$sessionData->setProperty('hello');


    //validate the post varibales
    unset($_POST['frmSubmit']);
    $validate =  true;
    $errorMsg = array();
    if(empty($storeName))
    {
        $errorMsg['storeName'] = 'Store Name Could not be blank';
    }else{
        if($storeName){
            $pattern = "/^[a-zA-Z0-9 ]+$/";
            if(!$db->validate($pattern, $storeName)){
                $errorMsg['storeName'] = 'Invalid Store Name!';
            }
        }
    }
    if(empty($storeAddress))
    {
        $errorMsg['storeAddress'] = 'Store Address Could not be blank';
    }else{
        if($storeAddress){
            $pattern = "/^[A-Za-z0-9 .]+$/";
            if(!$db->validate($pattern, $storeAddress)){
                $errorMsg['storeAddress'] = 'Invalid Store Address!';
            }
        }
    }
    if(empty($organization))
    {
        $errorMsg['organization'] = 'Organization Could not be blank';
    }else{
        if($organization){
            $pattern = "/^[A-Za-z0-9 ]+$/";
            if(!$db->validate($pattern, $organization)){
                $errorMsg['organization'] = 'Invalid Organization!';
            }

        }
    }
    if(empty($pickDate))
    {
        $errorMsg['pickDate'] = 'Select a Date';
    }else{
        if($pickDate){
            $pattern = "/^([0-9]{4})\/([0-9]{2})\/([0-9]{2})/";
            //if (preg_match("/([0-9]{2})\/([0-9]{2})\/([0-9]{4})/", $cnt_birthday, $matches)) {
            if($db->validate($pattern, $pickDate)){
                $formatDate = explode('/',$pickDate);
                $pickDate1    = $formatDate[0].'-'.$formatDate[1].'-'.$formatDate[2];
            }else{
                $errorMsg['pickDate'] = 'Invalid Pick Date!';
            }
        }
    }

    if(empty($errorMsg))
    {
        //save the details
        $insertArray = array(
            'storename'    => $storeName,
            'storeaddress' => $storeAddress,
            'organization' => $organization,
            'pickdate'     => $pickDate1
        );
        $db->insert($insertArray, 'storedetails');
        header( 'Location: success.php' ) ;
    }
    /*else{
        //print_r($errorMsg);die;
        header( 'Location: index.php' ) ;
        //renderPhpToString('index.php');
    }*/



}
?>



<div id="wrapper">
    <div id="header" class="clearfix">
    	<div class="center">
        <a href="http://about.good360.org/"><img src="/templates/gikinew/images/logo.gif" alt="" align="bottom" />
        </a>
        </div>
    </div>
    <div class="content-block">
        <?php if (isset($errorMsg)) {echo  "<p class='message'>Please fix the errors</p>" ;} ?>
        <div class="contact">
            <div id="contact-form-wrap" class="clearfix">
                <p>&nbsp;</p>
                <p class="good360"><strong>Nonprofit Donation Pickup Verification Page</strong></p>
                </div>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
              <p>&nbsp;</p>
                <form action="" method="post" id="contact-form" name="contact-form">
                    <fieldset>

                        <p id="lblStoreName">
                            <label>Store Number*</label>
                            <input type="text"  name="storeName"  id="storeName" value="<?php if(isset($storeName)){echo $storeName;} ?>"/>
                            <?php if(isset($errorMsg['storeName'])){echo "<p class='message'>".$errorMsg['storeName']."</p>";}?>
                        </p>
                        <p id="lblStoreAddress">
                            <label>Store Address*</label>
                            <input type="text" name="storeAddress" id="storeAddress"  value="<?php if(isset($storeAddress)){echo $storeAddress;} ?>" />
                            <?php if(isset($errorMsg['storeAddress'])){echo "<p class='message'>".$errorMsg['storeAddress']."</p>";}?>
                        </p>
                        <p id="lblOrganization">
                            <label>Name of Organization*</label>
                            <input type="text" name="organization" id="organization"  value="<?php if(isset($organization)){echo $organization;} ?>" />
                            <?php  if(isset($errorMsg['organization'])){echo "<p class='message'>".$errorMsg['organization']."</p>";}?>
                        </p>
                        <p id="lblPickDate">
                            <label>Date Of Pickup*</label>
                            <input type="text"  name="pickDate" id="pickDate"  value="<?php if(isset($pickDate)){echo $pickDate;} ?>" readonly="readonly"/>
                            <?php if(isset($errorMsg['pickDate'])){echo "<p class='message'>".$errorMsg['pickDate']."</p>";}?>
                        </p>
                        <p style="font-size:10px; margin:30px 0 0px">* mandatory</p>
                    </fieldset>
                    
                    <fieldset>
                    <input type="reset" class="reset"  value="Clear" id="frmRest" name="frmReset"/>
                        <input type="submit" class="reset"  value="Submit" id="frmSubmit" name="frmSubmit"/>
             		
                    </fieldset>
                </form>
                <p>&nbsp;</p>
        </div>
        </div>
        <a href="http://about.good360.org/">
		<p class="good360" style="margin:0px 310px 0px"> <strong>Click here to get more information about good360!</strong></p>
        </a>
    </div>
</div>
</body>
</html>


