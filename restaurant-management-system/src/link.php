<?php
	$link=mysqli_connect("localhost","root","","鹿村烤吧管理系統");

	if(!$link)
	{
		die(" Link Error:" . mysqli_connect_error());
	}
	//else
		//echo"Link successfully";
?>