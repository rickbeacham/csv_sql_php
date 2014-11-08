/**
 * Created with JetBrains PhpStorm.
 * User: rick
 * Date: 6/24/13
 * Time: 7:16 PM
 */
$(document).ready(function() {

    $("form").submit(function() {
        $("#lblStoreName").removeClass("error");
        $("#lblStoreAddress").removeClass("error");
        $("#lblPickDate").removeClass("error");
        $("#lblOrganization").removeClass("error");

        var errorflag = false;
        if ($("#storeName").val() == "") {
            $("#lblStoreName").addClass("error");
            errorflag = true;
        }
        if ($("#storeAddress").val() == "") {
            $("#lblStoreAddress").addClass("error");
            errorflag = true;
        }
        if ($("#organization").val() == "") {
            $("#lblOrganization").addClass("error");
            errorflag = true;
        }
        if ($("#pickDate").val() == "") {
            $("#lblPickDate").addClass("error");
            errorflag = true;
        }
        if(errorflag == true)
            return false;
        else{
            return true;
        }

    });
});