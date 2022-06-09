<?php

// session_start();

// echo '<h1>'.$_SESSION['title'].'</h1> <br>';
// echo '<p>'.$_SESSION['content'].'</p> <br>';
// echo '<img src="uploads/'.$_SESSION["imgname"].'">';

$file = fopen('info.txt', 'r') or die('Unable to open file!');
   while (!feof($file)) {

      $data = explode('||',fgets($file));
      // $id= $data[0];
      //var_dump($data);
      $ftitle= $data[1];
      $fcontent= $data[2];
      $fimgname= $data[3];

       echo '<h1>'.$ftitle.'</h1> <br>';
       echo '<p>'. $fcontent.'</p> <br>';
       echo '<img src="uploads/'. $fimgname.'">';
       echo '<br>'; 


   }

   fclose($file);




?>
