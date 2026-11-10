<?php
	$string="原料管理";
	echo '<span style="color: blue; font-size: 50px;"> ' . $string ;
?>
<!doctype html>

<html>
<head>
	
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
	<body>
<div class="container">
    <table class="table table-sm table-bordered"style="text-align:center;">
        <thead style="text_align:center;">
            <tr style="text-align:center;">
            <th><font size="5">進貨</font></th>
			<th><font size="5">盤點</font></th>
			<th><font size="5">返回</font></th>
            </tr>
        </thead>
	<tbody>
        
        
        <tr>
				<td><form action="purchase.php" method="POST"><input type="submit" value="進貨"></form></td>
				<td><form action="m_count.php" method="POST"><input type="submit" value="盤點"></form></td>
				<td><form action="index.php" method="POST"><input type="submit" value="返回"></form></td>
		</tr>
                
            </tbody>
        </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</html>
