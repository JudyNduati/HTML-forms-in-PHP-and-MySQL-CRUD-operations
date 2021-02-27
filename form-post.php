<?php 
# Include script to make a database connection
include("connect.php");
# Check if input fileds are empty
if(empty($_POST['name']) && empty($_POST['email'])){
    # If the fields are empty, display a message to the user
    echo "Please fill in the fields";
# Process the form data if the input fields are not empty
}else{
    $name= $_POST['name'];
    $email= $_POST['email'];
    echo ('Your Name is:     '. $name. '<br/>');
    echo ('Your Email is:'   . $email. '<br/>');
    # Insert into the database
    $query = "INSERT INTO user(name,email) VALUES ('$name','$email')";
    if (mysqli_query($conn, $query)) {
        echo "New record created successfully !";
    } else {
         echo "Error inserting record: " . $conn->error;
    }
}

# Button click to Delete
# Check that the input fields are not empty and process the data
if(!empty($_POST['delete']) && !empty($_POST['id'])){
    $query3 = "DELETE FROM user WHERE id='".$_POST['id']."' ";
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
    <form method="post" action="form-post.php">
        Name: <input type="text" name="name"><br><br/>
        Email: <input type="text" name="email"><br/>
        <br/>
        <input type="submit" name="save" value="submit" >
    </form>

    <h1>Inserted Data</h1>

<?php
# Read from the database and display in the table
$query2 = "SELECT * FROM user";
$result = $conn->query($query2);
if ($result->num_rows > 0) {
    // Output data of each row
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
       echo "<tr",">",
            "<td>", $row["id"],"</td>",
            "<td>", $row["name"],"</td>",
            "<td>", $row["email"],"</td>",
            "<td>",
                "<form action='update.php' method='post'>
                 <input name='id' value='",$row["id"],"' hidden >
                 <button type='submit' name='update' value='update'>Edit</button>
                </form>",
            "</td>",
            "<td>",
                "<form action='form-post.php' method='post'>
                 <input name='id' value='",$row["id"],"' hidden >
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








