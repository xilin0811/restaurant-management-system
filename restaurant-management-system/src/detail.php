<?php 
include('link.php');  
?>
<!DOCTYPE html>
<html lang="en">
<title>訂單細節</title>
<head>
	
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<form action='pay.php' method="POST">
   <p>
    <input type="submit" value="返回">
</p>

<body>

<?php 
	$query = "SELECT * FROM `點餐` WHERE `訂單編號`=".$_GET["id"]."";
	$query_run=mysqli_query($link,$query);
?>
<div class="container">

	<table class="table table-sm table-bordered"style="text-align:center;">
		<thead style="text-align:center;">
			<tr style="text-align:center;">
				<th>餐點名稱</th>
				<th>餐點單價</th>
				<th>餐點數量</th>
			</tr>
		</thead>

		<tbody>
			<?php
				if(mysqli_num_rows($query_run) > 0)
				{
					foreach($query_run as $row)
					{
			?>
							<tr>
								<td><?php echo $row["品項名稱"];$name=$row["品項名稱"]; ?></td> 
								<td><?php 
								$query1 = "SELECT * FROM `產品` WHERE `產品名稱`='$name'";
								$query_run1=mysqli_query($link,$query1);
								if(mysqli_num_rows($query_run1) > 0){
									foreach($query_run1 as $row1){
									echo $row1["產品價格"];}}	?></td>					
								<td><?php echo $row["品項數量"]; ?></td> 	
													
							</tr>
			<?php
				  }
				}
			?>
		</tbody>
	</body>

</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</html>