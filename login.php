<?php 

session_start();

	include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];

		if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
		{

			//read from database
			$query = "select * from users where user_name = '$user_name' limit 1";
			$result = mysqli_query($con, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					
					if($user_data['password'] === $password)
					{

						$_SESSION['user_id'] = $user_data['user_id'];
						header("Location: index.php");
						die;
					}
				}
			}
			
			echo "wrong username or password!";
		}else
		{
			echo "wrong username or password!";
		}
	}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>

<style type="text/css">
   body {
  font-family: Roboto, sans-serif;
  background-color: #fff;
}

#text, #button {
  width: 100%;
  padding: 10px;
  margin-bottom: 15px;
  border: none;
  border-radius: 5px;
  font-size: 16px;
}

#text {
  height: 40px;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

#button {
  color: white;
  background-color: #007BFF;
  cursor: pointer;
  font-weight: bold;
  transition: background-color 0.2s ease-in-out;
}

#button:hover {
  background-color: #0056b3;
}

#box {
  background-color: #ffffff;
  margin: auto;
  width: 300px;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.box-title {
  font-size: 24px;
  margin: 10px 0;
  color: #333;
  text-align: center;
}

.signup-link {
  color: #007BFF;
  text-decoration: none;
  font-size: 16px;
  text-align: center;
  transition: text-decoration 0.2s ease-in-out;
}

.signup-link:hover {
  text-decoration: underline;
}
</style>



	<div id="box">
		
		<form method="post">
			<div style="font-size: 20px;margin: 10px;color: white;">Login</div>

			<input id="text" type="text" name="user_name"><br><br>
			<input id="text" type="password" name="password"><br><br>

			<input id="button" type="submit" value="Login"><br><br>

			<a href="signup.php">Click to Signup</a><br><br>
		</form>
	</div>
</body>
</html>