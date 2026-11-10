<?php
	//include('link.php');
    $pdo=new PDO('mysql:host=localhost;dbname=鹿村烤吧管理系統;charset=utf8', 
	'root', '');
?>
<h3>商品盤點</h3>
<!doctype html>

<html>
<head>
	
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
	<body>
    <form action="product.php"method="post">
    <input type="submit"value="返回"></form>
<div class="container">
    <table class="table table-sm table-bordered"style="text-align:center;">
        <thead style="text_align:center;">
            <tr style="text-align:center;">
            <th><font size="5">商品名稱</font></th>
            <th><font size="5">商品現有數量</font></th>
            <th><font size="5">盤點商品數量</font></th>
            </tr>
        </thead>
	<tbody>
        <?php
        if(isset($_REQUEST['command'])){
            switch ($_REQUEST['command']){
            case 'update':
            $sql=$pdo->prepare('update 產品 set 產品數量=? where 產品名稱=?');
            $sql->execute([htmlspecialchars($_REQUEST['num']), $_REQUEST['id']]);
            break;    
        }
    }
        //if(mysqli_num_rows($result)>0){
            //foreach($result as $row){ 
        foreach ($pdo->query('SELECT * FROM 產品') as $row){             
        echo'<tr><form action="p_count.php"method="post">';
        echo '<input type="hidden" name="command" value="update">';
        echo '<input type="hidden" name="id" value="', $row['產品名稱'], '">';
        echo'<td><font size="5">',$row['產品名稱'],'</font></td>';
        echo'<td><font size="5">',$row['產品數量'],'</font></td>';
        echo'<td><input type="number" name="num" value=""></td>';
        echo'<td><input type="submit"value="登陸"></td>';
        echo'</form></tr>'; 
        }
                
            //}
        //}
        ?>
            </tbody>
        </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</html>
