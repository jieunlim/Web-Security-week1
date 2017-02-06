
<?php
  require_once('../private/initialize.php');


  // Set default values for all variables the page needs.
  //$first_name;
  //$last_name;
  //$email;
  //$username ;
  unset($errors);
  $errors = [];
  // if this is a POST request, process the form
  // Hint: private/functions.php can help
  $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
  $last_name = isset($_POST['last_name'])? $_POST['last_name']:'';
  $email = isset($_POST['email'])? $_POST['email']:'';
  $username = isset($_POST['username'])? $_POST['username']:'';

    // Confirm that POST values are present before accessing them.
    if(is_post_request()){

    // Perform Validations
    // Hint: Write these in private/validation_functions.php


      if(is_blank($_POST['first_name'])){
        $errors[] = "First name cannot be blank.";
      }else if(!has_length($_POST['first_name'], ['min' => 2, 'max' => 255])){
        $errors[] = "First name must be between 2 and 255 characters.";
      }

      if (is_blank($_POST['last_name'])) {
        $errors[] = "Last name cannot be blank.";
      } elseif (!has_length($_POST['last_name'], ['min' => 2, 'max' => 255])) {
        $errors[] = "Last name must be between 2 and 255 characters.";
      }

      if (is_blank($_POST['email'])) {
        $errors[] = "Email cannot be blank.";
      }elseif (has_valid_email_format($_POST['email'])) {
        $errors[] = "This is not valid email address.";
      }

      if (is_blank($_POST['username'])) {
        $errors[] = "User name cannot be blank.";
      } elseif (!has_length($_POST['username'], ['min' => 8, 'max' => 255])) {
        $errors[] = "User name must be between 8 and 255 characters.";
      }


    // if there were no errors, submit data to database
    if(!sizeof($errors)){
      // Write SQL INSERT statement
      // $sql = "";
      $DateTime = date("Y-m-d H:i:s");
      $sql = "INSERT INTO users (first_name, last_name, email, username, created_at)
              VALUES ('$firs_tname', '$last_name', '$email', '$username', '$DateTime')";

      // For INSERT statments, $result is just true/false
       $result = db_query($db, $sql);

       if($result) {
         db_close($db);

      //   TODO redirect user to success page
      header("Location: registration_success.php");
       exit;

       } else {
      //   // The SQL INSERT statement failed.
      //   // Just show the error, not the form
         echo db_error($db);
         db_close($db);
         exit;
       }
   }
}
?>

<?php $page_title = 'Register'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<html>
<body>
<div id="main-content">
  <h1>Register</h1>
  <p>Register to become a Globitek Partner.</p>




  <?php
    // TODO: display any form errors here
      echo display_errors($errors);
    // Hint: private/functions.php can help
  ?>

  <!-- TODO: HTML form goes here -->
  <form action="register.php" method="post">
   <label for = "firstname">First name: </label><br>
   <input type = "text" name="first_name" value="<?php echo $first_name; ?>"><br>



   <label for = "lastname">Last name: </label><br>
   <input type="text" name="last_name" value="<?php echo $last_name; ?>"><br>

   <label for = "email">Email: </label><br>
   <input type="text" name="email" value="<?php echo $email; ?>"><br>

   <label for = "username">Username: </label><br>
   <input type="text" name="username" value="<?php echo $username; ?>"><br><br>

   <div class = "dutton">
         <button type = "submit">Submit</button>
   </div>


 </form>

</div>
</body>
</html>

<?php include(SHARED_PATH . '/footer.php'); ?>
