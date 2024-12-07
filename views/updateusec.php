<?php
$servername = "localhost";
$username = "admin_st";
$password = "shu}hfubtF`$;%7P";
$dbname = "admin_ts_api_cl";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM admin_ts_api_cl.`users_staff`";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row

    while ($row = $result->fetch_array()) {
        $UniqueKey = uniqid(rand(), false);
        $sql_update = "UPDATE admin_ts_api_cl.users_staff SET `userid` = '$UniqueKey', `member_type` = 'staff' WHERE id = '".$row['id']."'";
        if ($conn->query($sql_update) === TRUE) {
            echo "Record updated successfully <br>";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
} else {
    echo "0 results";
}
$conn->close();
?>