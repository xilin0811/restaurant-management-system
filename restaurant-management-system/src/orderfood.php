<?php
session_start();
	//include('link.php');
    $pdo=new PDO('mysql:host=localhost;dbname=鹿村烤吧管理系統;charset=utf8', 
	'root', '');
?>
<h3>點餐</h3>
<!doctype html>

<html>
<head>
	
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
	<body>
    <?php
        //mysqli_query($link,"SEt CHARACTER SET UTF8");
        //$sql="SELECT * FROM 原料";
        //$result=mysqli_query($link,$sql);
    ?>

    <?php
        if(isset($_REQUEST['command'])){
            switch ($_REQUEST['command']){
            case 'update':
                echo'<div class="container">';
                echo'<table class="table table-sm table-bordered"style="text-align:center;">';
                echo'<thead style="text_align:center;">';
                echo'<tr style="text-align:center;">';
                echo'<th><font size="5">訂單內容</font></th>';
                echo'<th><font size="5">數量</font></th>';
                echo'</tr>';
                echo'</thead>';
            $sql0=$pdo->prepare('select * from 產品 where 產品名稱=?');
            $sql0->execute([$_REQUEST['id']]);
            foreach ($sql0->fetchAll() as $row){
                $sql=$pdo->prepare('insert into 點餐(訂單編號, 品項名稱, 品項數量) values(?, ?, ?)');
                $sql->execute([htmlspecialchars($_SESSION['id']), $_REQUEST['id'],$_REQUEST['num']]);
                $sql3=$pdo->prepare('update 產品 set 產品數量=? where 產品名稱=?');
                $sql3->execute([htmlspecialchars($row['產品數量']-($_REQUEST['num'])), $_REQUEST['id']]);
                $_SESSION['price']=($row['產品價格']*$_REQUEST['num'])+$_SESSION['price'];
            }
            if(isset($_SESSION['id'])){
                $sql=$pdo->prepare('select * from 點餐 where 訂單編號=?');
                $sql->execute([htmlspecialchars($_SESSION['id'])]);
                $sql2=$pdo->prepare('update 訂單 set 總價格=? where 訂單編號=?');
                $sql2->execute([htmlspecialchars($_SESSION['price']),($_SESSION['id'])]);
            }foreach ($sql->fetchAll() as $row){
                echo'<tbody>';
                echo'<td><font size="5">',$row['品項名稱'],'</font></td>';
                echo'<td><font size="5">',$row['品項數量'],'</font></td>';
                echo'</tbody>';
                echo'</div>';
	            //echo $row['品項名稱'];
	            //echo $row['品項數量'];
	            //echo "\n";
            }
            break;
        }
    }
    echo'<div class="container">';
    echo'<table class="table table-sm table-bordered"style="text-align:center;">';
    echo'<thead style="text_align:center;">';
    echo'<tr style="text-align:center;">';
    echo'<th><font size="5">商品名稱</font></th>';
    echo'<th><font size="5">商品價格</font></th>';
    echo'<th><font size="5">點餐商品數量</font></th>';
    echo'</tr>';
    echo'</thead>';
	echo'<tbody>';
        //if(mysqli_num_rows($result)>0){
            //foreach($result as $row){ 
        foreach ($pdo->query('SELECT * FROM 產品') as $row){             
        echo'<tr><form action="orderfood.php"method="post">';
        echo '<input type="hidden" name="command" value="update">';
        echo '<input type="hidden" name="id" value="', $row['產品名稱'], '">';
        echo'<td><font size="5">',$row['產品名稱'],'</font></td>';
        echo'<td><font size="5">',$row['產品價格'],'</font></td>';
        echo'<td><input type="number" name="num" value=""></td>';
        echo'<td><input type="submit"value="加入訂單"></td>';
        echo'</form></tr>'; 
        }
       
    echo'<form action="order.php" method="post">';
    echo'<fieldset>';
    echo'<p><input id="btn1" type="submit" value="確認訂單"></p>';
    echo'</fieldset>';
    echo'</form>';

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
