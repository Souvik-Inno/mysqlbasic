<?php

  // Stores data in database when form is submitted.
  require("classes/classFormData.php");
  $formData = new FormData();
  if (isset($_POST['formSubmit'])) {
    if ($formData->errorCheck()) {
      $formData->storeDB();
    }
  }
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags. -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
  <!-- Bootstrap CSS. -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <!-- Including style.css. -->
  <link rel="stylesheet" href="css/style.css">

  <title>SQL assign2</title>
  <!--  Including jquery. -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>

<body class="bg-image">
  <!-- Header starts here. -->
  <header class="bg-dark">
    <div class="header-container container">
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="navbar-brand" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
          </ul>
          <form class="form-inline my-2 my-lg-0">
            <button class="btn btn-outline-danger my-2 my-sm-0" type="submit">Log Out</button>
          </form>
        </div>
      </nav>
    </div>
  </header>

  <!-- Main Section with Form. -->
  <div class="main m-5">
    <div class="main-container container-form blur-container">
      <form class="assignForm m-3" method="post" action="assign2.php">
        <div class="form-group">
          <label for="inputFirstName">First Name</label>
          <input type="text" class="form-control" id="inputFirstName" name="inputFirstName" aria-describedby="emailHelp"
            placeholder="Enter First Name">
            <span class="red"><?php echo "{$formData->errors['inputFirstName']}"; ?></span>
        </div>
        <div class="form-group">
          <label for="inputLastName">Last Name</label>
          <input type="text" class="form-control" id="inputLastName" name="inputLastName" placeholder="Last Name">
          <span class="red"><?php echo "{$formData->errors['inputLastName']}"; ?></span>
        </div>
        <div class="form-group">
          <label for="inputGradPercent">Graduation Percentage:</label>
          <input type="text" class="form-control" id="inputGradPercent" name="inputGradPercent" placeholder="Grad Percent Eg. 65%">
          <span class="red"><?php echo "{$formData->errors['inputGradPercent']}"; ?></span>
        </div>
        <div class="form-group">
          <label for="inputSalary">Salary</label>
          <input type="text" class="form-control" id="inputSalary" name="inputSalary" placeholder="Enter Salary Eg. 20k">
          <span class="red"><?php echo "{$formData->errors['inputSalary']}"; ?></span>
        </div>
        <div class="form-group">
          <label for="inputCodeName">Enter your Code Name</label>
          <input type="text" class="form-control" id="inputCodeName" name="inputCodeName" placeholder="Enter Code Name">
          <span class="red"><?php echo "{$formData->errors['inputCodeName']}"; ?></span>
        </div>
        <div class="form-group">
          <label for="inputDomain">Enter your Domain</label>
          <input type="text" class="form-control" id="inputDomain" name="inputDomain" placeholder="Enter your Domain">
          <span class="red"><?php echo "{$formData->errors['inputDomain']}"; ?></span>
        </div>
        <button type="submit" name="formSubmit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>


  <!-- Optional JavaScript. -->
  <!-- JQuery first, then Popper.js, then Bootstrap JS. -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>

  <!-- Including jquery code. -->
  <script>
    
  </script>
</body>

</html>
