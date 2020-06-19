<?php
//Variables de Login
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "CursoXAMP";

// Create connection
//se ejecuta un login con las variables
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
//Manda mensajes de error, si es que existen
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
//sql, variable donde se almacena una cadena para consulta
$sql = "SELECT * FROM Usuarios";
//result, variable de conexion a la bd, que trae el resultado de la consulta almacenada como sql
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
	//el while permite imprimir los renglones de la tabla que obtuvimos en $result
  while($row = $result->fetch_assoc()) {
  	//echo, se usa para imprimir en pantalla
    echo "id: " . $row["idUsuario"]. " - Name: " . $row["Usuario"]. " " . $row["Rol"]. "<br>";
  }
} else {
  echo "0 results";
}

//-----------
$sqlJoin = "SELECT uc.idUsuario_Curso, u.Usuario, u.Rol, c.nombre, c.calif, c.fecha_inicio, c.status
			from usuario_curso uc inner join usuarios u on u.idUsuario=uc.idUsuario
			inner join cursos c on c.id = uc.idCurso
			where u.idUsuario = 1";
//result, variable de conexion a la bd, que trae el resultado de la consulta almacenada como sql
$resultJoin = $conn->query($sqlJoin);

if ($result->num_rows > 0) {
  // output data of each row
	//el while permite imprimir los renglones de la tabla que obtuvimos en $result
  while($row = $resultJoin->fetch_assoc()) {
  	//echo, se usa para imprimir en pantalla
    echo "id: " . $row["idUsuario_Curso"]. " - Usuario: " . $row["Usuario"]. " Rol " . $row["Rol"]. " Alumno " . $row["nombre"].  " calif " . $row["calif"]. " Fecha Inicio " . $row["fecha_inicio"]. " Status " . $row["status"]."<br>";
  }
} else {
  echo "0 results";
}
//-----------
//se cierra la conexion
$conn->close();
?>