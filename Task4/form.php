<?php


    function clean($input){
        
        $input = trim($input); 
        $input = stripslashes($input); 
        $input = strip_tags($input); 
        return $input;
        
        // return strip_tags(stripslashes(trim($input))); 

    }


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // CODE .... 

    $name     = clean($_POST['name']);
    $email    = clean($_POST['email']);
    $password = clean($_POST['password']);
    $address  = clean($_POST['address']);
    $url      = clean($_POST['lnkurl']);
    $gender   = $_POST['gender'];
   
    // Array To Store Errors Messages . . . 
    $errors = [];

    if (!empty($_FILES['CV']['name'])) {

        $tempName  = $_FILES['CV']['tmp_name'];
      //  $fileName = $_FILES['CV']['name'];
        $fileType = $_FILES['CV']['type'];

        $extensionArray = explode('/', $fileType);
        $extension =  strtolower( end($extensionArray));

      //  $allowedExtensions = ['pdf'];   

        if ($extension == 'pdf') {

            $finalName = uniqid() . time() . '.' . $extension;

            $disPath = 'CVs/' . $finalName;

            if (move_uploaded_file($tempName, $disPath)) {
                echo 'File Uploaded Successfully';
            } else {
                $errors['file'] = 'Uploaded Failed';
            }
        } else {
            $errors['file'] = 'Type Not Allowed';
        }
        } else {
            $errors['file'] = 'Please Select File';
        }


    # validate name . . .
    if (empty($name)) {    // == if(empty($name) == true)
        $errors['name'] = 'Field is Required';
    }elseif (!ctype_alpha(str_replace(' ', '', $name))) {
        $errors['name'] = 'Name must be only letters';
    }



    # validate email . . .
    if (empty($email)) {
        $errors['email'] = 'Field is Required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Invalid Email';
    }


    # Validate password . . . 
    if (empty($password)) {
        $errors['password'] = 'Field is Required';
    } elseif (strlen($password) < 6) {
        $errors['password'] = 'Password must be at least 6 characters';
    }


    # Validate address . . . 
    if (empty($address)) {
        $errors['address'] = 'Field is Required';
    } elseif (strlen($address) != 10) {
        $errors['address'] = 'Address must be 10 characters';
    }

     # Validate gender . . . 
     if (!isset($gender)) {
        $errors['gender'] = 'Field is Required';
     }

     # Validate Url . . . 
     if(empty($url)){
        $errors['lnkurl'] = 'Field is Required';
    }
    if(!empty($url)){
        $urlarr = explode('/',$url);
       // var_dump($urlarr); //2
      if($urlarr[2]!='www.linkedin.com'){
          $errors['linkd'] = 'the url should be linkedin only';//https://www.linkedin.com/login/ar

      }
  }

    # Check errors 

    if (count($errors) > 0) {

        foreach ($errors as $key => $value) {
            # code...
            echo $key . ' : ' . $value . '<br>';
        }
    } else {
            
         echo 'Data passed Successfully !';
      

    }
}


?>


<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Register</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>

    <body>

        <div class="container">
            <h2>Register</h2>
            <!-- action.php -->
            <form method="post" action="<?php echo  htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="exampleInputName">Name</label>
                    <input type="text" class="form-control" name="name" id="exampleInputName" aria-describedby="" placeholder="Enter Name">
                </div>


                <div class="form-group">
                    <label for="exampleInputEmail">Email address</label>
                    <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword">Password</label>
                    <input type="password" class="form-control" name="password" id="exampleInputPassword" placeholder="Password">
                </div>

                <div class="form-group">
                    <label for="exampleInputAddress">Address</label>
                    <input type="text" class="form-control" name="address" id="exampleInputAddress" aria-describedby="" placeholder="Enter Address">
                </div> 


                <div class="form-group">
                    <label for="exampleInputUrl">linkedin </label>
                    <input type="url" class="form-control" name="lnkurl"  id="exampleInputUrl" aria-describedby="emailHelp" placeholder="Enter linkedin url">
                </div>

                <!-- <div class="form-group">
                    <label for="exampleInputGender">Gender </label> <br>
                    <input type="radio" name="gender" value="male" id='exampleInputGender'> Male<br>
                    <input type="radio" name="gender" value="female" id='exampleInputGender'> Female<br>
                </div> -->



                <div class="form-group">
                <label for="exampleInputGender">Gender</label>
                <select name="gender" class="form-control" id='exampleInputGender'>
                <option value="male">male</option>
                <option value="female">female</option>
                </select>
                </div>


                 <div class="form-group">
                    <label for="exampleInputPassword">CV</label>
                    <input type="file" name="CV">
                </div>


                <button type="submit" class="btn btn-primary">Submit</button>

            </form>
        </div>

    </body>

</html>