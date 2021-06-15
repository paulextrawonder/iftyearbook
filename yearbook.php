<?php
include_once 'config.php';

$error = array();

$name = $comment = "";

if(isset($_POST["yearbook"])){

       //set parameters
    $name = trim($_POST['name']);
    $comment = trim($_POST['comment']);

    if (empty($name) || empty($comment)) {
      array_push($error, "Field must not be empty");
      
    }
  
    if (!empty($error)) {
      header('location:yearbook?action=yearbook');
    }
   
    if (empty($error)) {

        // ------------------ Image validation ------------------

        $file =($_FILES['file']) ; // Checks and declares the file the file type 
        $img_name = $_FILES['file']['name']; // The name of uploaded image
        $tmp_name = $_FILES['file']['tmp_name']; // temporary storage name of the file
        $size = $_FILES['file']['size']; // size of the file to upload
        $error = $_FILES['file']['error']; // error of the file to be uploaded

        //explode from punctuation
        //explode function basically splits a string into separate arrays 
        //takes in two argurements, first is the point to split, second is the file to explode
        $tmpExtension = explode('.', $img_name);
        $fileExtension = strtolower(end($tmpExtension));

        //allowed extensions
        $isAllowed = array('jpg','jpeg','png'); // sets of allowwable image formats
            if (!empty($fileExtension)) {      
              if(in_array($fileExtension, $isAllowed)){
                if ($error === 0) {
                    if ($size<500 * 1024) {
                        $newFileName = uniqid('', true).'.'.$fileExtension;
                        // $fileDestination = "../uploads/".$newFileName;
                        $fileDestination = "yearbk/".$newFileName;
                        move_uploaded_file($tmp_name, $fileDestination);

                                                 
                }else{
                       
                         array_push($error, "sorry your file size is too big");
                }
                }else{
                    
                        array_push($error, "There was an error please try again");
                }
                }else{
                    
                        array_push($error, "Sorry your file type is not accepted");
                } 
                }else{
                        array_push($error,  "Please Select a file");

                }

 
        $sql = "INSERT INTO yearbook (name, comment, upload) VALUES (?,?,?)";
         
        if($stmt = mysqli_prepare($dbconnected, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $name, $comment, $fileDestination);
         
                    
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
            echo "<script>alert('Profile added to yearbook successfully')</script>";
            echo "<script>window.open('index?action=yearbook', '_self')</script>";
                
            } else{
              array_push($error, "Year Book update not successfull");
              header("location:index?action=yearbook");
            }

            // Close statement
            mysqli_stmt_close($stmt);

}

}
}



if(isset($_POST["throwback"])){
  
        $file =($_FILES['file']) ; // Checks and declares the file the file type 
        $img_name = $_FILES['file']['name']; // The name of uploaded image
        $tmp_name = $_FILES['file']['tmp_name']; // temporary storage name of the file
        $size = $_FILES['file']['size']; // size of the file to upload
        $error = $_FILES['file']['error']; // error of the file to be uploaded

        //explode from punctuation
        //explode function basically splits a string into separate arrays 
        //takes in two argurements, first is the point to split, second is the file to explode
        $tmpExtension = explode('.', $img_name);
        $fileExtension = strtolower(end($tmpExtension));

        //allowed extensions
        $isAllowed = array('jpg','jpeg','png'); // sets of allowwable image formats
            if (!empty($fileExtension)) {      
              if(in_array($fileExtension, $isAllowed)){
                if ($error === 0) {
                    if ($size<500 * 1024) {
                        $newFileName = uniqid('', true).'.'.$fileExtension;
                        // $fileDestination = "../uploads/".$newFileName;
                        $fileDestination = "throwback/".$newFileName;
                        move_uploaded_file($tmp_name, $fileDestination);

                                                 
                }else{
                       
                         array_push($error, "sorry your file size is too big");
                }
                }else{
                    
                        array_push($error, "There was an error please try again");
                }
                }else{
                    
                        array_push($error, "Sorry your file type is not accepted");
                } 
                }else{
                        array_push($error,  "Please Select a file");

                }

            

        $sql = "INSERT INTO throwback (upload) VALUES (?)";
         
        if($stmt = mysqli_prepare($dbconnected, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $fileDestination);
         
                    
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
            echo "<script>alert('Throwback added successfully')</script>";
            echo "<script>window.open('index?action=throwback', '_self')</script>";
                
            } else{
              array_push($error, "Throwback not successfull");
              header('location:index.php?action=throwback');
            }

            // Close statement
            mysqli_stmt_close($stmt);

}
// Close connection
    mysqli_close($dbconnected);
}
 ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>IFT - Year Book</title>
  <link
    href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
  <link rel="stylesheet" type="text/css" href="css/main2.css">
  <link rel="stylesheet" href="css/sweetalert2.min.css">
</head>

<body>
  <center>
    <div class="form__group">

      <button name="yearbook" class="btn__submit" style="font-size: 1.6rem; font-weight: 700">
        <a style="color:#fff; text-decoration: none;" href="yearbook.php?action=yearbook">Year Book</a></button>
      <button name="throwback" class="btn__submit" style="font-size: 1.6rem; font-weight: 700">
        <a style="color:#fff; text-decoration: none;" href="yearbook.php?action=throwback">Thowback</a></button>
    </div>
  </center>
      

      <?php

      if ($_GET['action']=="yearbook") {
       ?>

  <!-- Registration Container Section -->
  <div class="registration-container">
    <div class="registration__box">
      <i class="wave"></i>
      <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" enctype="multipart/form-data" class="form responsive-width">
        <div class="form__group">
          <h2 class="form__title responsive-h2">IFT Year Book 2020</h2>
          <p class="form__text responsive-p">Fill in your details Now lets get our year book rolling.</p>
        </div>
        <div>
          <center style="color: red; font-size: 14px;">
          <?php foreach ($error as $err) {
            echo "$err"."<br>";
          } ?>
        </center>
        </div>
        <div class="form__group">
          <input type="text" name="name" placeholder="Full Name" class="form__input" id="name" required />
          <label for="name" class="form__label">Full Name *</label>
        </div>
        

        <div class="form__group">
          <textarea name="comment" class="form__input">Comment</textarea>
          <label for="comment" class="form__label">Comment*</label>

        </div>

        <div class="form__group">
          <input type="file" name="file" placeholder="ID Photo" class="form__input" id="id-photo" required />
          <label for="id-photo" class="form__label">Your Photo *</label>
        </div>
        
        <div class="form__group">
          <button type="yearbook" name="yearbook" class="btn__submit" style="font-size: 1.6rem; font-weight: 700">Submit</button>
           <p class="btn__text" style="color: #183152; font-size: 1.8rem; font-weight: 700; margin-top: 2.5rem;">
            <a href="#" class="form__link" style="font-weight: 600;">Return to HomePage</a>
          </p>
        </div>
      </form>
    </div>
  </div>
  <!--End of Registration Container Section -->

  <?php

} 
if ($_GET['action']=="throwback") {


  ?>

  <!-- Registration Container Section -->
  <div class="registration-container">
    <div class="registration__box">
      <i class="wave"></i>
      <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" enctype="multipart/form-data" class="form responsive-width">
        <div class="form__group">
          <h2 class="form__title responsive-h2">IFT Throw Back 2020</h2>
          <p class="form__text responsive-p">Share your memories with us.</p>
        </div>
        <div>
          <center style="color: red; font-size: 14px;">
          <?php foreach ($error as $err) {
            echo "$err"."<br>";
          } ?>
        </center>
        </div>
       
        <div class="form__group">
          <input type="file" name="file" placeholder="ID Photo" class="form__input" id="id-photo" required />
          <label for="id-photo" class="form__label">Your Photo *</label>
        </div>
        
        <div class="form__group">
          <button type="throwback" name="throwback" class="btn__submit" style="font-size: 1.6rem; font-weight: 700">Submit</button>
           <p class="btn__text" style="color: #183152; font-size: 1.8rem; font-weight: 700; margin-top: 2.5rem;">
            <a href="#" class="form__link" style="font-weight: 600;">Return to HomePage</a>
          </p>
        </div>
      </form>
    </div>
  </div>
  <!--End of Registration Container Section -->


<?php
}
?>



  <!--Footer Section -->
  <footer class="footer responsive-padding">
    <div class="footer__social">
      <p class="footer__social--p">Social media handles</p>
      <div class="social">
        <a href="#">
          <i class="fab fa-whatsapp"></i>
        </a>
       <a href="">
          <i class="fab fa-instagram"></i>
        </a>

        <a href="">
          <i class="fab fa-telegram-plane"></i>
        </a>
       
      </div>
    </div>
    <div class="footer__text" style="text-align: center !important;">
      &copy; Information Technology - FUTO 2021. All Rights Reserved.
    </div>
  </footer>
  <!--End of Footer Section -->
  <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>
  <script src="js/app.js"></script>
  <script src="js/sweetalert2.js"></script>

</body>

</html>