<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"></meta>
 <meta name="viewport" content="width=device-width,initial-scale=1.0">
 <title>結帳</title>
 <link rel="stylesheet" href="css/workorder.css" />
</head>
<body>
<header>
<div>
<table id="head_table">
<tr>
<td id="head_td1"><div>訂單列表</div>
</td>
<td id="head_td3">
<div>
<form action='order.php' method="POST">
   <p>
    <input type="submit" value="返回">
</p>
</form>
</div>
</td>
</tr>
</table>
</div>
</header>
<section>
<?php
require("link.php");

date_default_timezone_set('Asia/Taipei');
    $start=strtotime(date('Y/m/d').'00:00:00');
    $end=strtotime(date('Y/m/d').'23:59:59');
    $start=date('Y-m-d H:i:s',$start);
    $end=date('Y-m-d H:i:s',$end);
    $result=mysqli_query($link,"SELECT * FROM `訂單` WHERE (`訂單時間` BETWEEN '$start' AND '$end')");


echo "<div class=\"show_table\">";
echo "<div class=\"show_table_row\">";
echo "<div class=\"show_table_col_1\">訂單編號</div>";
echo "<div class=\"show_table_col_2\">桌號</div>";
echo "<div class=\"show_table_col_1\">總價格</div>";
echo "<div class=\"show_table_col_1\">訂單細節</div>";
echo "<div class=\"show_table_col_1\">訂單時間</div>";
echo "<div class=\"show_table_col_1\">訂單狀態</div>";
echo "<div class=\"show_table_col_1\">結帳</div>";
echo "</div>";

while($row1=@mysqli_fetch_assoc($result))
{
    
    echo "<div class=\"show_table_row\">";
    echo "<div class=\"show_table_col_3\">".$row1["訂單編號"]."</a></div>";
    echo "<div class=\"show_table_col_4\">".$row1["桌號"]."</a></div>";
    echo "<div class=\"show_table_col_3\">".$row1["總價格"]."</div>";
    echo "<div class=\"show_table_col_3\"><a style=color:blue href=\"detail.php?id=".$row1["訂單編號"]."\">"."訂單細節"."</a></div>";
    echo "<div class=\"show_table_col_3\">".$row1["訂單時間"]."</div>";
    echo "<div class=\"show_table_col_3\">".$row1["訂單狀態"]."</div>";
    echo "<div class=\"show_table_col_3\"><a style=color:red href=\"changestate.php?id=".$row1["訂單編號"]."\">"."結帳"."</a></div>";
    echo "</div>";
    
}
echo "</div>";

?>
</section>
</body>
</html>