<?php
/**
 * Created by JetBrains PhpStorm.
 * User: rick
 * Date: 6/24/13
 * Time: 10:01 PM
 */

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>list </title>
    <link href="styles.css" type="text/css" rel="stylesheet"  />

</head>

<body>
<?php
require_once 'dbConnection.php';
$db = new dbConnection();
$results = $db->selectAll('storedetails');
?>

<div id="wrapper">
    <div id="header" class="clearfix">
    </div>
    <div class="content-block">
        <div class="contact">
            <div id="contact-form-wrap" class="clearfix">
                <table>
                    <tr>
                        <td>No</td>
                        <td>Store Number</td>
                        <td>Store Address</td>
                        <td>Organization</td>
                        <td>Pick Date</td>
                        <td>Added Date</td>
                    </tr>
                    <?php foreach($results as $result){?>
                        <tr>
                            <td><?php echo $result['id'];?></td>
                            <td><?php echo $result['storename'];?></td>
                            <td><?php echo $result['storeaddress'];?></td>
                            <td><?php echo $result['organization'];?></td>
                            <td><?php echo $result['pickdate'];?></td>
                            <td><?php echo $result['addeddate'];?></td>
                        </tr>
                    <?php }?>
                    <tr>
                        <td colspan="5" ><a href="csv.php">Download as csv<a/> | <a href="index.php">back</a></td>

                    </tr>
                </table>
            </div>
        </div>

    </div>
</div>
</body>
</html>





