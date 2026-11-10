<?php
session_start();
include('link.php')
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"></meta>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" href="css/employee_add.css" />
	<title>選擇桌號</title>
</head>

<body>
<header>
<div>
<table id="head_table">
<tr>
<td id="head_td1"><div>選擇桌號</div>
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
<fieldset>
    <p id="text1">
    <form action="order_id.php" method="post">
  <select name="did">
      <option value="0">0</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      <option value="6">6</option>
  </select></p>
  <p><input type="submit" value="選擇桌號"></p>
</form>
</fieldset>
</center>
</div>

</section>
</body>
</html>