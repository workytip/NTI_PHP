<?php
######## MY FAILED TRIES TASK 1 #####
    // $num1=10;
    // $num2 = 20;
    // echo 'before swap first number '.$num1.' and second number '. $num2 .'<br>' ; 
    
    // //$num1= &$num2 ; // 20
    // //$$num2=$num1 ; 
    // //($num1=$num2 && $num2=$num1);

    // define('num2',$num1); //10
    //$num1=$num2  ;//20
    // var_dump($num2);
    // $num2 =&$num1;// 10
    // $num1=&$num2;
   
    // $num2= $num1; // 10
    // $num1 = $$num2; // 20
    // echo 'after swap first number '.$num1.' and second number '. $num2 ; 
 

 ##### TASK 1 WITH SOME GOOGLE HELP ######

    $num1 = 10;  $num2 = 20;  
    echo 'Before swap first number IS'.$num1.' and second number IS'. $num2 .'<br><br>' ; 

    $num1= $num1+$num2; // 30
    $num2 = $num1 - $num2 ; // 10
    $num1 = $num1 -$num2; 

    ### TASK 2 AS WELL ###

    echo 'After swap first number IS'.$num1.' and second number IS'. $num2 ; 

?>