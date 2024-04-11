<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link  rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css">
  <?php require('inc/links.php'); ?>
  <title>Manipal Hotels - Rooms</title>
  
</head>
<body class="bg-light">

  <?php require('inc/header.php'); ?>
  
  <div class="my-5 px-4">
    <h2 class="fw-bold  text-center">CONTACT US</h2>
    
    <p class="text-center mt-3">
      This site is created by Himank, Madhav and Raiyan . Feel free to ask us any queries.
    </p>
  </div>

  <div class="container text-center">
    <div class="row">
      <div class="col-lg-6 mx-auto px-4">
        <div class="bg-white rounded shadow p-4">
          <form method="POST">
            <h5>Send a message</h5>
            <div class="mt-3">
              <label class="form-label" style="font-weight: 500;">Name</label>
              <input name="name" required type="text" class="form-control ">
            </div>
            <div class="mt-3">
              <label class="form-label" style="font-weight: 500;">Email</label>
              <input name="email" required type="email" class="form-control ">
            </div>
            <div class="mt-3">
              <label class="form-label" style="font-weight: 500;">Subject</label>
              <input name="subject" required type="text" class="form-control ">
            </div>
            <div class="mt-3">
              <label class="form-label" style="font-weight: 500;">Message</label>
              <textarea name="message" required class="form-control " rows="5" style="resize: none;"></textarea>
            </div>
            <button type="submit" name="send" class="btn text-white custom-bg mt-3">SEND</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <?php require('inc/footer.php'); ?>

 <!-- Backend -->
  <?php
if (isset($_POST['send'])) {
    // Retrieve form data from $_POST
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Insert data into the "user_queries" table
    $sql = "INSERT INTO user_queries (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";

    if (mysqli_query($con, $sql)) {
        echo "Data inserted successfully.";
    } else {
        echo "Error " ;
    }

}
?>

</body>
</html>