<?php 

require 'dbConnection.php';

#  Clean Function to sanitize the data
function  Clean($input)
{
    return stripslashes(strip_tags(trim($input)));
}



$link = "https://wikimedia.org/api/rest_v1/metrics/pageviews/per-article/en.wikipedia/all-access/all-agents/Tiger_King/daily/20210901/20210930";

$jsonObj = file_get_contents($link);

$data =    json_decode($jsonObj,true);

//print_r($data);

# Validate ...... 
$errors = [];



foreach($data as $key => $items)
{
    foreach($items as $k => $details)
    {
        $project=     clean($details['project']) ;
        $article=     clean($details['article'] );
        $granularity= clean($details['granularity']) ;
        $timestamp=   clean($details['timestamp']) ;
        $access=      clean($details['access']) ;
        $agent=       clean($details['agent']) ;
        $views=       clean($details['views']) ;

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

        $query = "INSERT INTO items(project,article,granularity,timestamp,access,agent,views)
        VALUES('$project','$article','$granularity','$timestamp','$access','$agent','$views')";
        $op =  mysqli_query($con, $query);

            if ($op) {
                echo "Success ";
            } else {
                echo "Failed , " . mysqli_error($con);
            }
       
    }
}


$_SESSION['message'] = 'API Data Saved';

header("Location: display.php");
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


   <h1>Fetching Data </h1>
   <?php 
    
    
   
   ?>
    
</body>
</html>