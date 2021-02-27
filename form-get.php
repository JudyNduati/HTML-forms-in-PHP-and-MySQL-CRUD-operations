<?php
# Include script to make a database connection
include("connect.php");
# Check if input fileds are empty
if(empty($_GET['name']) && empty($_GET['email'])){
    # If the fields are empty, display a message to the user
    echo "Please fill in the fields";
    # Process the form data if the input fields are not empty
}else{
    $name= $_GET['name'];
    $email= $_GET['email'];
    echo ('Welcome:     '. $name. '<br/>');
    echo ('This is your email address:'   . $email. '<br/>');
    // Insert into the database
	$query = "INSERT INTO user(name,email) VALUES ('$name','$email')";
	if (mysqli_query($conn, $query)) {
	    echo "New record created successfully !";
	} else {
	   echo "Error inserting record: " . $conn->error;
	}
}

# Button click to Delete
# Check that the input fields are not empty and process the data
if(!empty($_GET['delete']) && !empty($_GET['id'])){
	$query3 = "DELETE FROM user WHERE id='".$_GET['id']."' ";
    if (mysqli_query($conn, $query3)) {
	    echo "Record deleted successfully !";
	} else {
      # Display an error message if unable to delete the record
	     echo "Error deleting record: " . $conn->error;
	}
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>PHP FORMS</title>
</head>
<body>
    <h1>PHP Form</h1>
    <form method="get" action="form-get.php">
        Name: <input type="text" name="name"><br><br/>
        Email: <input type="text" name="email"><br/>
        <br/>
        <input type="submit" value="submit" >
    </form>
    <h1>Inserted Data</h1>
<?php
// Read From the database and display in the table
$query2 = "SELECT * FROM user";
$result = $conn->query($query2);
if ($result->num_rows > 0) {
    // output data of each row
    echo "<table id='tsa' border='1' id='example' class='table table-striped responsive-utilities table-hover'>
            <thead>
               <tr>
               <th>ID</th>
               <th>Name</th>
               <th>Email</th>
               <th>Action 1</th>
               <th>Action 2</th>
               </tr>
            </thead>
              ";
    while($row = $result->fetch_assoc()) {
       echo "<tr id='green' ",">",
            "<td>", $row["id"],"</td>",
            "<td>", $row["name"],"</td>",
            "<td>", $row["email"],"</td>",
            "<td>",
              "<form action='update.php' method='get'>
               <input name='id' value='",$row["id"],"' hidden>
               <button type='submit' name='update' value='update'>Edit</button>
              </form>",
            "</td>",
            "<td>",
              "<form action='form-get.php' method='get'>
  			   	   <input name='id' value='",$row["id"],"' hidden>
  			   	   <button type='submit' name='delete' value='delete'>Delete</button>
  				    </form>",
            "</td>",
            "</tr>";
    }
    echo  "</table>";
}else {
  echo "No Records!";
}
?>
</body>
</html>




