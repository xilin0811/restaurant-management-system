<?php
session_start();
include('link.php')
?>
<script>
function warn1()
{
    alert("新增成功!");
}
</script>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"></meta>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" href="css/employee_add.css" />
	<title>訂單新增</title>
</head>

<body>
<header>
<div>
<table id="head_table">
<tr>
<td id="head_td1"><div>新增訂單內容</div>
</td>
<td id="head_td2">
<div><form action='order.php' method="POST">
<p><input type="submit" value="返回"></p>
</form>
</div>
</td>
</tr>
</table>
</div>
</header>

<section>
<div>
<center>
<?php 
date_default_timezone_set('Asia/Taipei');
$time = date('Y/m/d H:i:s');
$_SESSION['time']=$time;
$Did=$_POST['did'];
$_SESSION['desknum']=$Did;
$ID=date('md', time()).substr(time(), -6);
$_SESSION['id']=$ID;
$state="未結帳";
$_SESSION['state']=$state;
$price='0';
$_SESSION['price']=$price;
$sql ="INSERT INTO `訂單` (`訂單編號`,`桌號`,`訂單狀態`,`訂單時間`,`總價格`) VALUES ('$ID','$Did','$state','$time','$price')";
if(mysqli_query($link,$sql))
    {
        echo "<script>warn1();</script>";
        //echo '<meta http-equiv=REFRESH CONTENT=0.5;url=employee_add.php>';
    }
    header("location:orderfood.php");
	//$query = "SELECT * FROM 產品  "; 
    //$query_run = mysqli_query($link,$query);
?>


</form>
</center>
</div>

</section>
</body>
</html>