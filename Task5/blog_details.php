<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
</html>

<?php


$file = fopen('info.txt', 'r+') or die('Unable to open file!');


   while (!feof($file)) { // LOOP THE FILE LINE BY LINE EACH LINE IS A STR

      $strdata=fgets($file);
     
      $data = explode('||',$strdata);//ONE STR LINE ID-TITLE-CONTENT-IMGNAME TO ARRAY
      
      $fimgname= $data[3];
      
      echo '<h1>'.$data[1].'</h1> <br>';
      echo '<p>'. $data[2].'</p> ';
      echo '<img style="width:200px; height:200px;" src="uploads/'. $data[3].'"><br>';
     
     
       echo '<form method="get" action="blog_details.php"> <br>
       <input type="submit" name="delete" class="btn btn-warning" value="Delete">
       </form>';

       echo '<br><br>'.str_repeat('-',150);
       if(isset($_GET['delete']))
       {
         var_dump($strdata);
       
         $filename = "info.txt";
         $fileHandle= fopen($filename,"r+");
         // DELETE INFO FROM TXT FILE
         for($i=0 ; $i<strlen($strdata);$i++)
         {
            fseek($fileHandle,$i,SEEK_SET);
             fwrite($fileHandle,"-"); // erase data line by line
            //  $strdata = str_replace('-','',$strdata);
            //  fwrite($fileHandle,$strdata);
         }

             fclose($fileHandle);
             //DELETE IMG FROM UPLOADS
             $imgfile="uploads//". $fimgname;
             $imgfilehandle= fopen($imgfile,"r+");
             fclose($imgfilehandle);
             unlink($imgfile); 
         
       }
       
   }
   
   fclose($file);
   




?>
