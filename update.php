<?php
# Include script to make a database connection
include("connect.php");
# Empty string to be used later
$name='';
$email='';
$id='';

# Button click to update using POST method
if(!empty($_POST['update']) && !empty($_POST['id']) )  {
  $id=$_POST['id'];
  # Fetch record with ID and populate it in the form
  $query2 = "SELECT * FROM user WHERE id='".$_POST['id']."' ";
  $result = $conn->query($query2);
  if ($result->num_rows > 0) {
    # Output data for each row
    while($row = $result->fetch_assoc()) {
      $name=$row["name"];
      $email=$row["email"];
    }
    echo "Current Details: " ."<b> - Name:</b> " . $name. " <b>Email:</b>" . $email. "<br>";
  } else {
    echo "Error updating";
  }
}

# Button click to update using GET method
if(!empty($_GET['update']) && !empty($_GET['id']) )  {
  $id=$_GET['id'];
  # Fetch record with id and populate it in the form
  $query2 = "SELECT * FROM user WHERE id='".$_GET['id']."' ";
  $result = $conn->query($query2);
  if ($result->num_rows > 0) {
    # Output data for each row
    while($row = $result->fetch_assoc()) {
      $name=$row["name"];
      $email=$row["email"];
    }
    echo "Current Details: " ."<b> - Name:</b> " . $name. " <b>Email:</b>" . $email. "<br>";
  } else {
    echo "Error updating";
  }
}
# Check that the input fields are not empty and process the data
if(!empty($_POST['name']) && !empty($_POST['email'])){
    # Insert into the database
  $query = "UPDATE user SET name='".$_POST['name']."', email='".$_POST['email']."' WHERE id='".$id."' ";
  if (mysqli_query($conn, $query)) {
      echo "Record updated successfully!<br/>";
      echo '<a href="form-get.php">Get Form</a><br/>
            <a href="form-post.php">Post Form</a>';
      die(0);
  } else {
      # Display an error message if unable to update the record
       echo "Error updating record: " . $conn->error;
  }
}
?>