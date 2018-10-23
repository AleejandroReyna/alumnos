<?php
	if(isset($_POST['name'])) {
		$name = $_POST['name'];
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "ear_test";
		
		$conn = new mysqli($servername, $username, $password, $dbname);

		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		
		$query = "INSERT INTO alumnos (name) VALUES('" . $name . "')";
		
		if($conn->query($query) == TRUE) {
			echo 'Alumno con nombre ' . $name . ' creado con exito';
		} else {
			echo 'Error al crear registro';
		}
	}
?>
<html>
	<head>
		<title>Agregar alumno</title>
	</head>
	<body>
		<form action="./agregar_alumno.php" method="POST">
			<input type='text' name='name' placeholder='ingrese nombre del alumno'>
			<input type="submit" value="agregar alumno">
		</form>
		<a href="./">Volver</a>
	</body>
</html>