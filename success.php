<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Regis NPO Pickup Receipt Page</title>
    <link href="styles.css" type="text/css" rel="stylesheet"  />
    <link rel="stylesheet" href="jquery-ui.css" />
    <link href="/templates/gikinew/favicon.ico" rel="shortcut icon" type="image/x-icon" />


<div id="wrapper">
    <div id="header" class="clearfix">
        <div class="center">
            <a href="http://about.good360.org/"><img src="/templates/gikinew/images/logo.gif" alt="" align="bottom" />
            </a>
        </div>
    </div>
    <div class="content-block">
        <div class="tblcontact">
            <div id="contact-form-wrap" class="clearfix">
                <p>&nbsp;</p>
                <p class="good360" style="margin:0px 375px 0px"><strong> This is your receipt.</strong></p>
            </div>
            <p>&nbsp;</p>
            &nbsp;
            <table style="margin: 0px 125px 0px">
                <tr >
                    <td  class="tbllabel">Store Number</td>
                    <td  class="tbllabel">Store Address</td>
                    <td  class="tbllabel">Organization</td>
                    <td  class="tbllabel">Pickup Date</td>
                </tr>
                <tr>
                    <td class="tbllabel"><?php echo $_SESSION['storeName'];?></td>
                    <td class="tbllabel"><?php echo $_SESSION['storeAddress'];?></td>
                    <td class="tbllabel"><?php echo $_SESSION['organization'];?></td>
                    <td class="tbllabel"><?php echo $_SESSION['pickDate'];?></td>
                </tr>
            </table>
        </div>
    </div>
    <a href="http://about.good360.org/">
        <p class="good360" style="margin:0px 310px 0px"> <strong>Click here to get more information about good360!</strong></p>
    </a>
</div>
</div>
</body>
</html>

