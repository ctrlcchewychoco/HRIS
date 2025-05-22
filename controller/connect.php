<?php
	
	class database
	{
		
		function connection()
		{
			return mysqli_connect('localhost:3370','root','','newhrm');
		}
	}

?>	