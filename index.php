<html>
	<head>
		<title>Alumnos</title>
	</head>
	<body>
<?php 
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "ear_test";
	
	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	$sql = "SELECT * FROM alumnos";
	$result = $conn->query($sql);
	
	if($result->num_rows > 0) { ?>
	<ul>
	<?php while($row = $result->fetch_assoc()) { ?>
	<li><strong><?php echo $row["name"];?> </strong> - <a href="./alumno.php?id=<?php echo $row["id"]; ?>">Ver</a></li>
	<?php	} ?>
	</ul><?php
	} else {
?>		<h2>Sin resultados</h2> 
<?php
	}
?>
<a href="./agregar_alumno.php">Agregar alumno</a>
</body>
</html>