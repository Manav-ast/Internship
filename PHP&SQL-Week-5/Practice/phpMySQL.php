<?php
// $servername = "localhost:3307";
// $username = "root";
// $password = "";

// // Create connection
// $conn = new mysqli($servername, $username, $password);
// // Check connection
// if ($conn->connect_error) {
//   die("Connection failed: " . $conn->connect_error);
// }

// // Create database
// $sql = "CREATE DATABASE IF NOT EXISTS myDB";
// if ($conn->query($sql) === TRUE) {
//   echo "Database created successfully";
// } else {
//   echo "Error creating database: " . $conn->error;
// }

// $conn->close();
?>


<?php
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "myDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// sql to create table
// $sql = "CREATE TABLE MyGuests (
// id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
// firstname VARCHAR(30) NOT NULL,
// lastname VARCHAR(30) NOT NULL,
// email VARCHAR(50),
// reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
// )";

// if ($conn->query($sql) === TRUE) {
//   echo "Table MyGuests created successfully";
// } else {
//   echo "Error creating table: " . $conn->error;
// }

// $sql = "INSERT INTO MyGuests (firstname, lastname, email)
// VALUES ('John', 'Doe', 'john@example.com');";
// $sql .= "INSERT INTO MyGuests (firstname, lastname, email)
// VALUES ('Mary', 'Moe', 'mary@example.com');";
// $sql .= "INSERT INTO MyGuests (firstname, lastname, email)
// VALUES ('Julie', 'Dooley', 'julie@example.com')";

// if($conn->multi_query($sql) === TRUE){
//   $lastID = $conn->insert_id;
//   echo "New record created successfully. Last inserted ID is: " . $lastID;
// }
// else{
//   echo "Error: " . $sql . "<br>" . $conn->error;
// }

// $conn->close();
?>


<?php
// $servername = "localhost:3307";
// $username = "root";
// $password = "";
// $dbname = "myDB";

// // Create connection
// $conn = new mysqli($servername, $username, $password, $dbname);

// // Check connection
// if ($conn->connect_error) {
//   die("Connection failed: " . $conn->connect_error);
// }

// // prepare and bind
// $stmt = $conn->prepare("INSERT INTO MyGuests (firstname, lastname, email) VALUES (?, ?, ?)");
// $stmt->bind_param("sss", $firstname, $lastname, $email);

// // set parameters and execute
// $firstname = "John";
// $lastname = "Doe";
// $email = "john@example.com";
// $stmt->execute();

// $firstname = "Mary";
// $lastname = "Moe";
// $email = "mary@example.com";
// $stmt->execute();

// $firstname = "Julie";
// $lastname = "Dooley";
// $email = "julie@example.com";
// $stmt->execute();

// echo "New records created successfully";

// $stmt->close();
// $conn->close();
?>


<?php
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "myDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// $sql = "SELECT id, firstname, lastname FROM MyGuests";
// $sql = "SELECT id, firstname, lastname FROM MyGuests WHERE lastname='Doe'";
// $sql = "SELECT id, firstname, lastname FROM MyGuests ORDER BY lastname DESC";
// $sql = "DELETE FROM MyGuests WHERE id=3";
$sql = "UPDATE MyGuests SET lastname='Doe' WHERE id=2";
$result = $conn->query($sql);

// if ($result->num_rows > 0) {
//   // output data of each row
//   while($row = $result->fetch_assoc()) {
//     echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
//   }
// } else {
//   echo "0 results";
// }

if ($conn->query($sql) === TRUE) {
  echo "Record updated successfully";
} else {
  echo "Error updating record: " . $conn->error;
}
$conn->close();
?>