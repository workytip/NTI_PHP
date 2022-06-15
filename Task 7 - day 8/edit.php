<?php

require 'dbConnection.php';


##################################################################################################################
 
$id = $_GET['id'];
$sql = "select * from items where id = $id";
$resultObj = mysqli_query($con, $sql);
$data = mysqli_fetch_assoc($resultObj);

##################################################################################################################







# Clean Function to sanitize the data
function Clean($input)
{
    return stripslashes(strip_tags(trim($input)));
}



# Server Side Code . . . 
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $project=     clean($_POST['project']) ;
    $article=     clean($_POST['article'] );
    $granularity= clean($_POST['granularity']) ;
    $timestamp=   clean($_POST['timestamp']) ;
    $access=      clean($_POST['access']) ;
    $agent=       clean($_POST['agent']) ;
    $views=       clean($_POST['views']) ;


    # Validate ...... 
    $errors = [];

    # validate inputs .... 

    if (empty($project)) {
        $errors['project'] = "Field Required";
    }
    if (empty($article)) {
        $errors['article'] = "Field Required";
    }
    if (empty($granularity)) {
        $errors['granularity'] = "Field Required";
    }
    if (empty($timestamp)) {
        $errors['timestamp'] = "Field Required";
    }
    if (empty($access)) {
        $errors['access'] = "Field Required";
    }
    if (empty($agent)) {
        $errors['agent'] = "Field Required";
    }
    if (empty($views)) {
        $errors['views'] = "Field Required";
    }



    # Check ...... 
    if (count($errors) > 0) {
        // print errors .... 

        foreach ($errors as $key => $value) {
            # code...

            echo '* ' . $key . ' : ' . $value . '<br>';
        }
    } else {

        // DB cODE . . . 


        $sql = "update items set project = '$project', article = '$article' , granularity = '$granularity' ,timestamp='$timestamp',access='$access',agent='$agent',views='$views' where id = $id";

        $op =  mysqli_query($con, $sql);

        if ($op) {
            $message =  "Success , API Data Updated";

            $_SESSION['message'] = $message;
            
            header('Location: display.php');
            exit(); 

        } else {
            echo "Failed , " . mysqli_error($con);
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Update</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>Update Info : </h2>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']).'?id='.$data['id']; ?>" method="post" ">

            <div class="form-group">
                <label for="exampleInputName">Project</label>
                <input type="text" class="form-control" required  name="project" placeholder="Enter project"  value = "<?php echo $data['project'];?>">
            </div>

            <div class="form-group">
                <label for="exampleInputName">Project</label>
                <input type="text" class="form-control" required  name="article" placeholder="Enter article"  value = "<?php echo $data['article'];?>">
            </div>

            <div class="form-group">
                <label for="exampleInputName">Project</label>
                <input type="text" class="form-control" required  name="granularity" placeholder="Enter granularity"  value = "<?php echo $data['granularity'];?>">
            </div>

            <div class="form-group">
                <label for="exampleInputName">Project</label>
                <input type="text" class="form-control" required  name="timestamp" placeholder="Enter timestamp"  value = "<?php echo $data['timestamp'];?>">
            </div>

            <div class="form-group">
                <label for="exampleInputName">Project</label>
                <input type="text" class="form-control" required  name="access" placeholder="Enter access"  value = "<?php echo $data['access'];?>">
            </div>

            <div class="form-group">
                <label for="exampleInputName">Project</label>
                <input type="text" class="form-control" required  name="agent" placeholder="Enter agent"  value = "<?php echo $data['agent'];?>">
            </div>

            <div class="form-group">
                <label for="exampleInputName">Project</label>
                <input type="text" class="form-control" required  name="views" placeholder="Enter views"  value = "<?php echo $data['views'];?>">
            </div>


            


           
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>


</body>

</html>


<?php 
mysqli_close($con);
?>
