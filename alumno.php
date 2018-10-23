<?php 

$id = $_GET['id'];
?>

<html>
<head>
	<title>Alumno <?php echo $id ?></title>
</head>
<body>

<?php 
	
	$id = $_GET['id'];
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "ear_test";
	
	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	$alumno_sql = "SELECT * FROM alumnos WHERE id = " . $id;
	$sql = "SELECT * FROM examenes WHERE alumno_id = " . $id;
	$result = $conn->query($sql);
	$alumno_result = $conn->query($alumno_sql);
	
	$alumno = $alumno_result->fetch_assoc();
	
	?><h2>Alumno: <?php echo $alumno['name']?></h2><?php
	if($result->num_rows > 0) { ?>
		<ul>
		<?php while($row = $result->fetch_assoc()) { 
		$second_sql = "SELECT * FROM materias WHERE id = " . $row['materia_id'];
		$materia = "";
		$second_result = $conn->query($second_sql);
		
		if($second_result->num_rows > 0) {
			while($second_row = $second_result->fetch_assoc()) {
				$materia = $second_row['name'];
			}
		}
		?>
		<li><strong><?php echo $materia; ?> </strong> - <span><?php echo $row['nota']; ?></span></li>
		<?php	} ?>
		</ul>
		<?php
		} else {
		?><h2>Sin resultados</h2> 
	<?php
		}
?>
</body>
</html>