<html>
	<head>
		<title>Đăng Ký</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	</head>
	<body>
		<?php
		require ("BackEnd/ConnectionDB/DB_driver.php");

		if (isset($_POST["btn_submit"])) {
  			//lấy thông tin từ các form bằng phương thức POST
            $ho=$_POST["ho"];
            $name=$_POST["name"];
  			$username = $_POST["username"];
  			$password = $_POST["password"];			
  			$email = $_POST["email"];
            $phone = $_POST["phone"];
  			//Kiểm tra điều kiện bắt buộc đối với các field không được bỏ trống
			  if ($username == "" || $password == "" || $email == ""|| $name == ""|| $phone == ""|| $ho == "" ) {
				   echo "bạn vui lòng nhập đầy đủ thông tin";
  			}else{
  					// Kiểm tra tài khoản đã tồn tại chưa
  					$sql="select * from users where username='$username'";
					$kt=mysqli_query($conn, $sql);
                    $pass_hash= password_hash($password, PASSWORD_DEFAULT);
					if(mysqli_num_rows($kt)  > 0){
						echo "Tài khoản đã tồn tại";
					}else{
						//thực hiện việc lưu trữ dữ liệu vào db
	    				$sql = "INSERT INTO users(
                            ho,
                            ten,
	    					taikhoan,
	    					matkhau,
                            email,
						    sdt
	    					) VALUES (
                            '$ho',
                            '$name',
	    					'$username',
	    					'$pass_hash',
	    					'$email',,
                            '$phone'
	    					)";
					    // thực thi câu $sql với biến conn lấy từ file connection.php
   						mysqli_query($conn,$sql);
				   		echo "chúc mừng bạn đã đăng ký thành công";
					}
									    
					
			  }
	}
	?>
	<form action="register.php" method="post">
		<table>
           
			<tr>
				<td colspan="2">Đăng ký tài khoản</td>
			</tr>	
            <tr>
				<td>Họ</td>
				<td><input type="text" id="ho" name="ho"></td>
			</tr>
            <tr>
				<td>Tên :</td>
				<td><input type="text" id="name" name="name"></td>
			</tr>
			<tr>
				<td>Tên đăng nhập :</td>
				<td><input type="text" id="username" name="username"></td>
			</tr>
			<tr>
				<td>Mật khẩu :</td>
				<td><input type="password" id="password" name="password" ></td>
			</tr>
			<tr>
				<td>Email :</td>
				<td><input type="text" id="email" name="email"></td>
			</tr>
            <tr>
				<td>Số điện thoại :</td>
				<td><input type="text" id="phone" name="phone"></td>
			</tr>
			<tr>
				<td colspan="2" align="center"><input type="submit" name="btn_submit" value="Đăng ký"></td>
			</tr>           

		</table>

	</form>
	</body>
</html>