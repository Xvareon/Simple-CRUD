<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>C R U D</title>
</head>

<body>

<!-- Insert data into the table -->
<form method="post" action="">
    <label><br><b>SIMPLE CRUD</b><br></label>
    <label><br>Input details to create a user:<br></label>
    <label for="name">Name:</label>
    <input type="text" id="name" name="name"><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email"><br>

    <label for="number">Number:</label>
    <input type="text" id="number" name="number"><br>

    <input type="submit" name="submit" value="Create">
</form>

<!-- Update data in the table -->
<form method="post" action="">
    <label for="id"><br>Input ID here to update a user:<br></label>
    <input type="text" id="id" name="id"><br>

    <label for="name">Name:</label>
    <input type="text" id="name" name="name"><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email"><br>

    <label for="number">Number:</label>
    <input type="text" id="number" name="number"><br>

    <input type="submit" name="update" value="Update">
</form>

<!-- Delete data from the table -->
<form method="post" action="">
    <label for="id"><br>Input ID here to delete a user:<br></label>
    <input type="text" id="id" name="id"><br>

    <input type="submit" name="delete" value="Delete">
</form>

<!-- Get data from the table -->
<form method="post" action="">
    <label for="id"><br>Input ID here to get a user or leave it blank to get all users upon submission:<br></label>
    <input type="text" id="id" name="id"><br>

    <input type="submit" name="get" value="Get">
</form>

<!-- ########################################################### DB SETUP ########################################################### -->
<?php // Display entered data

require_once ('MysqliDb.php');

    // Display last data created
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $number = $_POST['number'];
        echo "<p> ---------------------------------------</p>";
        echo "<p>Name: $name</p>";
        echo "<p>Email: $email</p>";
        echo "<p>Number: $number</p>";
    }

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "CRUD_DB";

$db = new MysqliDb($servername, $username, $password, $dbname);

// Check connection
if (!$db) {
    die("Connection failed: " . $db->getLastError());
}

// Create a table
$sql = "CREATE TABLE IF NOT EXISTS CRUD_DB (
    id INT(50) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30) NOT NULL,
    email VARCHAR(50),
    number INT(50),
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

########################################################### CREATE ###########################################################
// Create data and insert it to the table
if (isset($_POST["submit"])) {
    // Get the form data
    $data = [
        "name" => $_POST['name'],
        "email" => $_POST['email'],
        "number" => $_POST['number']
    ];

    $id = $db->insert('CRUD_DB', $data);

    // Error handling for data insertion
    if($id)
        echo 'user was created. Id=' . $id;
    else {
        echo "Error updating record: " . $db->getLastError();
    }
    unset($_POST);
}else{
    $name ="";
    $email="";
    $number=0;
}

echo "<br>";

########################################################### UPDATE ###########################################################
// Update data from the table
if (isset($_POST["update"])) {
    // Get the form data
    $id = $_POST['id'];
    $data = [
        "name" => $_POST['name'],
        "email" => $_POST['email'],
        "number" => $_POST['number']
    ];

    $db->where ('id', $id);

    // Error handling for data update
    if ($db->update('CRUD_DB', $data)) {
        if ($db->count > 0) {
            echo "Record updated successfully<br>";
        } else {
            echo "IDs do not match or it does not exist";
        }
    } else {
        echo "Error updating record: " . $db->getLastError();
    }
    unset($_POST);
}else{
    $name ="";
    $email="";
    $number=0;
}

echo "<br>";

########################################################### DELETE ###########################################################
// Delete data from the table
if (isset($_POST["delete"])) {
    // Get the form data
    $id = $_POST['id'];

    $db->where('id', $id);

    // Error handling for data deletion
    if ($db->delete('CRUD_DB')) {
        if ($db->count > 0) {
            echo "deleted successfully<br>";
        } else {
            echo "ID does not exist";
        }
    } else {
        echo "Error deleting record: " . $db->getLastError();
    }
    unset($_POST);
}

echo "<br>";

########################################################### READ ###########################################################
// Read data from the table
if (isset($_POST["get"])) {
    // Get the form data
    $id = $_POST['id'];

    // get all data or select an id
    if ($id == null){
        echo "printing all data <br>";
    }
    if ($id != null){
        $db->where('id', $id);
    }
    
    $cols = Array ("id", "name", "email", "number");

    // get the db
    $CRUD_DB = $db->get("CRUD_DB", null, $cols);

    // list the db
    if ($db->count > 0)
        foreach ($CRUD_DB as $row) {
        echo "<br>id: " . $row["id"]. " - Name: " . $row["name"]. " - Email: " . $row["email"]. " - Number: " . $row["number"]. "<br>";
    }else{
        echo "0 results";
    }
    unset($_POST);
}

########################################################### END ###########################################################

// Close php section
?> 

</body>

</html>