<!-- 

2 - Create a form with the following inputs (name, email, linkedin url) 
Validate inputs then return message to user . 
* validation rules ... 
name  = [required , string (Accept only letters) , min length 3 , max length 20]
email = [required]
linkedin url = [required | linked Url]
Notes … 
Don't use html  js  php filters || regx  To validate inputs.  -->

<?php

    
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // CODE .... 

    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $url      = $_POST['lnkurl'];
   
    // Array To Store Errors Messages . . . 
    $errors = []; 

    # validate name . . .
    if(empty($name)){   
          $errors['name'] = 'Field is Required';
    } 
    if(!is_string($name) or is_numeric($name) )
    {
        $errors['type']='name should be letters only';
    }
    if(strlen($name) < 3 or strlen($name) >20 )
    {
        $errors['length']='name should be more than 3 and less than 20 chars';
    }
    # validate email . . .
      if(empty($email)){
          $errors['email'] = 'Field is Required';
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

       if(count($errors) > 0){

           foreach ($errors as $key => $value) {
               # code...
               echo $key.' : '.$value.'<br>';
           }
       }else{
              echo 'Success';
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

        <form  method="post"  action=<?=$_SERVER['PHP_SELF']?>>

            <div class="form-group">
                <label for="exampleInputName">Name</label>
                <input type="text" class="form-control"   name="name"  id="exampleInputName" aria-describedby="" placeholder="Enter Name">
            </div>


            <div class="form-group">
                <label for="exampleInputEmail">Email address</label>
                <input type="email" class="form-control" name="email"  id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            </div>

            <div class="form-group">
                <label for="exampleInputUrl">linkedin </label>
                <input type="url" class="form-control" name="lnkurl"  id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter linkedin url">
            </div>

           


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</body>

</html>