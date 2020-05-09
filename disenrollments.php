<?php include "../inc/dbinfo.inc"; ?>
<html>
<body>
<h1>Dis-Enrollment</h1>
<?php

  /* Connect to MySQL and select the database. */
  $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

  if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

  $database = mysqli_select_db($connection, DB_DATABASE);

  /* If input fields are populated, add a row to the EMPLOYEES table. */
  $student_id = htmlentities($_POST['STID']);
  $course_id = htmlentities($_POST['CID']);
  $dnt = htmlentities($_POST['DNT']);
  $cmts = htmlentities($_POST['CMTS']);

  if (strlen($student_id) ||strlen($course_id) || strlen($dnt) || strlen($cmts)) {
    DisEnrollments($connection, $student_id, $course_id, $dnt, $cmts);
  }
?>

<!-- Input form -->
<form action="<?PHP echo $_SERVER['SCRIPT_NAME'] ?>" method="POST">
  <table border="0">
    <tr>
      <td>STU_ID</td>
      <td>COURSE_ID</td>
      <td>DATE AND TIME</td>
      <td>COMMENTS</td>
    </tr>
    <tr>
      <td>
        <input type="text" name="STID" maxlength="10" size="15" />
      </td>
      <td>
        <input type="text" name="CID" maxlength="10" size="15" />
      </td>
      <td>
        <input type="datetime-local" name="DNT" maxlength="20" size="10" />
      </td>
      <td>
        <input type="text" name="CMTS" maxlength="50" size="30" />
      </td>
      <td>
        <input type="submit" value="Dis-Enroll" />
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
function DisEnrollments($connection, $student_id, $course_id, $dnt, $cmts) {
   $sid = mysqli_real_escape_string($connection, $student_id);
   $cid = mysqli_real_escape_string($connection, $course_id);
   $dt = mysqli_real_escape_string($connection, $dnt);
   $c = mysqli_real_escape_string($connection, $cmts);

   /*$query = "DELETE FROM DISENROLLMENTS (STUDENTID, COURSEID) WHERE  DATETIME, COURSE1, COURSE2) 
   VALUES ('$sid', '$cid', '$dt', '$c');";*/
   
   /*if(mysqli_query($connection, $query)) echo("<p>Enrollment Successful.</p>");*/
   if(!mysqli_query($connection, $query)) echo("<p>DisEnrollment Unsuccessful.</p>");
}

?>