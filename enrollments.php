<?php include "../inc/dbinfo.inc"; ?>
<html>
<body>
<h1>Course Enrollment</h1>
<?php

  /* Connect to MySQL and select the database. */
  $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

  if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

  $database = mysqli_select_db($connection, DB_DATABASE);

  /* If input fields are populated, add a row to the EMPLOYEES table. */
  $student_id = htmlentities($_POST['STID']);
  $student_name = htmlentities($_POST['NAME']);
  $student_email = htmlentities($_POST['EMAIL']);
  $student_course1 = htmlentities($_POST['COURSE1']);
  $student_course2 = htmlentities($_POST['COURSE2']);

  if (strlen($student_id) ||strlen($student_name) || strlen($student_email) || 
  strlen($student_course1) || strlen($student_course2)) {
    AddEnrollments($connection, $student_id, $student_name, $student_email, $student_course1, $student_course2);
  }
?>

<!-- Input form -->
<form action="<?PHP echo $_SERVER['SCRIPT_NAME'] ?>" method="POST">
  <table border="0">
    <tr>
      <td>STUDENT ID</td>
      <td>NAME</td>
      <td>EMAIL</td>
      <td>COURSE1</td>
      <td>COURSE2</td>
    </tr>
    <tr>
      <td>
        <input type="text" name="STID" maxlength="10" size="15" />
      </td>
      <td>
        <input type="text" name="NAME" maxlength="45" size="30" />
      </td>
      <td>
        <input type="text" name="EMAIL" maxlength="90" size="40" />
      </td>
      <td>
        <input type="text" name="COURSE1" maxlength="30" size="30" />
      </td>
      <td>
        <input type="text" name="COURSE2" maxlength="30" size="30" />
      </td>
      <td>
        <input type="submit" value="Enroll" />
      </td>
    </tr>
  </table>
</form>

<!-- Clean up. -->
<?php

  mysqli_free_result($result);
  mysqli_close($connection);

?>

</body>
</html>

<?php

/* Add student course to the table. */
function AddEnrollments($connection, $student_id, $student_name, $student_email, $student_course1,
 $student_course2) {
   $sid = mysqli_real_escape_string($connection, $student_id);
   $n = mysqli_real_escape_string($connection, $student_name);
   $e = mysqli_real_escape_string($connection, $student_email);
   $c1 = mysqli_real_escape_string($connection, $student_course1);
   $c2 = mysqli_real_escape_string($connection, $student_course2);

   $query = "INSERT INTO ENROLLMENTS (STUDENTID, STUDENTNAME, EMAIL, COURSE1, COURSE2) 
   VALUES ('$sid', '$n', '$e', '$c1', '$c2');";
   
   /*if(mysqli_query($connection, $query)) echo("<p>Enrollment Successful.</p>");*/
   if(!mysqli_query($connection, $query)) echo("<p>Enrollment Unsuccessful.</p>");
}

?>