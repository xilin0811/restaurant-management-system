<script>
function warn1()
{
    alert("已結帳!");
}
</script>
<?php
session_start();
include("link.php");
 
$state="已結帳";
    $sql2="UPDATE `訂單` SET `訂單狀態`='$state' WHERE `訂單編號`=".$_GET["id"]."";
  
    if(mysqli_query($link,$sql2))
    {
        //echo "<script>warn1();</script>";
        echo "<script> {window.alert('已結帳!');location.href='pay.php'} </script>";
        //echo '<meta http-equiv=REFRESH CONTENT=0.5;url=pay.php>';
    }
mysqli_close($link);
?>