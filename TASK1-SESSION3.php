<!-- # Tasks 
1- Write a function that takes a two-dimensional array and returns 
a one-dimensional array containing the unique values of each array
 (Without using the array_merge  function on PHP). 

I.e. input will be:
[  0 => [0=>'a' , 1=>'b' ,  2=>'c' ] ,
   1 => [0=>'x' , 1=>'b' , 2=>'a'],
   2 => [0=>'z' , 1=>'z' , 2=>'v']
 ]

Output should be:
[a,b,c,x,z,v] -->

<?php


function mergarr($twodimnArrs)
{   $valarr=array();
    $newarr=array();
    foreach($twodimnArrs as $outkey => $internArr)
    {
        
        foreach($internArr as $k => $values)
        {
       
              $valarr[]=$values; //['a','b','c','a']
          
         }
    }
    $newarr=array_unique($valarr);
    print_r($newarr) ;
    
}


$carr=
[   0 => [0=>'a' , 1=>'b', 2=>'c' ] ,
    1 => [0=>'x' , 1=>'b' , 2=>'a'],
    2 => [0=>'z' , 1=>'z' , 2=>'v']
];


 mergarr($carr);


?>











<!-- 

2 - Create a form with the following inputs (name, email, linkedin url) 
Validate inputs then return message to user . 
* validation rules ... 
name  = [required , string (Accept only letters) , min length 3 , max length 20]
email = [required]
linkedin url = [required | linked Url]
Notes … 
Don't use html  js  php filters || regx  To validate inputs.  -->