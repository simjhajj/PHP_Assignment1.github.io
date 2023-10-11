<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
      // including 2 php files to access their classes
      include_once ('validate.php');
      include_once ('database.php');
     
      // craete an object in validate class
      $valid = new validate();
      
      // check if form was submitted
      if(!empty($_POST['Submit'])){
        // retirieve and sanitize out validate class 
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $licenseNumber = $_POST['licenseNumber'];
        $phoneNumber = $_POST['phoneNumber'];
        $email = $_POST['email'];
        $vehicleYear = $_POST['vehicleYear'];
        $model = $_POST['model'];
        $mileage = $_POST['mileage'];
        $registrationNumber = $_POST['registrationNumber'];
        $capacity = $_POST['capacity'];
        $engineType = $_POST['engineType'];

        // check for empty fields using checkEmpty() method
        $msg = $valid->checkEmpty($_POST, array('fname', 'lname', 'licenseNumber', 'phoneNumber', 'email', 'vehicleYear', 'model', 'mileage', 'registrationNumber', 'capacity', 'engineType'));
        // check phone number using validPhoneNumber method
        $checkPhoneNumber = $valid->validPhoneNumber($_POST['phoneNumber']);
        // check email using validEmail method
        $checkEmail = $valid->validEmail($_POST['email']);
      
        // if data in inserted print msg
        if($msg != null){
          echo $msg;
          echo "<a href='javascript:self.history.back();'>Go Back</a>";
        }
        // if phone number is not valid
        elseif(!$checkPhoneNumber){
          echo '<p>Please provide a valid age.</p>';
          echo "<a href='javascript:self.history.back();'>Go Back</a>";
        }
        // if email is not valid
        elseif(!$checkEmail){
          echo '<p>Please provide a valid email.</p>';
          echo "<a href='javascript:self.history.back();'>Go Back</a>";
        }
        // if everything entered by user is correct insert data in database
        else{
          
          $result = $database->execute("INSERT INTO truckdriver(fname, lname, licenseNumber, phoneNumber, email, vehicleYear, model, mileage, registrationNumber, capacity, engineType) VALUES('$fname', '$lname', '$licenseNumber', '$phoneNumber', '$email', '$vehicleYear', '$model', '$mileage', '$registrationNumber', '$capacity', '$engineType')");
         
          if($result){
            echo "<p>Data added successfully.</p>";
            echo "<a href='view.php'>View Result</a>";
          }
               
        }
      }
    ?>
    
</body>
</html>