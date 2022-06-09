<?php

   // session_start();
    function clean($input){
        
        $input = trim($input); 
        $input = stripslashes($input); 
        $input = strip_tags($input); 
        return $input;
        
        // return strip_tags(stripslashes(trim($input))); 

    }


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // CODE .... 

    $title     = clean($_POST['title']);
    $content    = clean($_POST['content']);
   
    
   
    // Array To Store Errors Messages . . . 
    $errors = [];

    # validate title . . .
    if (empty($title)) {    
        $errors['title'] = 'Field is Required';
    }elseif (!ctype_alpha(str_replace(' ', '', $title))) {
        $errors['title'] = 'title must be at least 30 chars';
    }

    
        # validate title . . .
    if (empty($content)) {    
        $errors['content'] = 'Field is Required';
    }elseif (strlen($content)< 50) {
        $errors['content'] = 'content must be at least 50 chars';
    }

  # validate image . . .
    if (!empty($_FILES['image']['name'])) {

        $tempName  = $_FILES['image']['tmp_name'];
        $imageName = $_FILES['image']['name'];
        $imageType = $_FILES['image']['type'];

        $extensionArray = explode('/', $imageType);
        $extension =  strtolower( end($extensionArray));

        $allowedExtensions = ['png', 'jpg', 'jpeg', 'webp'];    // PNG 

        if (in_array($extension, $allowedExtensions)) {

            $finalName = uniqid() . time() . '.' . $extension;

            $disPath = 'uploads/' . $finalName;

            if (count($errors) == 0){
                if (move_uploaded_file($tempName, $disPath)) {
                    echo 'File Uploaded Successfully';
            }
            
            } else {
                $errors['thefile'] = 'Uploaded Failed';
            }
            } else {
                $errors['thefile'] = 'Type Not Allowed';
            }
            } else {
                $errors['thefile'] = 'Please Select File';
            }
        

    


    # Check errors 

    if (count($errors) > 0) {

        foreach ($errors as $key => $value) {
            # code...
            echo $key . ' : ' . $value . '<br>';
        }
    } else {

        $file = fopen('info.txt', 'a') or die('Unable to open file!');


        $text = time().rand(1,30)."||".$title . "||" . $content . "||" . $finalName . "\n";

        fwrite($file, $text);

        fclose($file);
        
// $_SESSION['title']=$title;
// $_SESSION['content']=$content;
// $_SESSION['imgname']=$finalName;

            
         echo 'Data passed Successfully !';
      

    }
}


?>


<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Blog</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>

    <body>

        <div class="container">
            <h2>Blog</h2>
            <!-- action.php -->
            <form method="post" action="<?php echo  htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="exampleInputName">Title</label>
                    <input type="text" class="form-control" name="title" id="exampleInputName" aria-describedby="" placeholder="Enter Name">
                </div>


                <div class="form-group">
                    <label for="exampleInputName">Content</label>
                    <input type="text" class="form-control" name="content" id="exampleInputName" aria-describedby="" placeholder="Enter Name">
                </div>

                <div class="form-group">
                <label for="exampleInputPassword">Image</label>
                <input type="file" name="image">
                  </div>


                <button type="submit" class="btn btn-primary">Submit</button>
                <span class="btn btn-warning">  <a href="blog_details.php#">Browse Data </span></a><br>

               

            </form>
        </div>

    </body>

</html>