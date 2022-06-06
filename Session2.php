<?php

/* TASKS

1 - Write a PHP function to print the next character of 
a specific character.
input : 'a'
Output : 'b'
input : 'z'
Output : 'a'
*/

function Printchar($mychar)
{
    echo ++$mychar.'<br><br>';
}

Printchar('a');
// z prints aa !!

###################################

/*
2 - Write a PHP function to get the characters after 
the last '/' in an url. Go to the editor
Sample URL : 'http://www.example.com/5478631'
Expected Output : '5478631'
*/

function Lastchars($mystring)
{
    $thechar= explode('/',$mystring);
  // var_dump($thechar);
    echo $thechar[count($thechar)-1];

    echo '<br><br>';
}
$url ='http://www.example.com/5478631';
Lastchars($url);


/*
3 - Write PHP function that takes an HTML tag as string 
and returns its ID value if existed or false if it
 has no ID
example: When calling
getTagID('<div id="container">');
it will return the string: container

Deadline tomorrow at 8:00 AM*/


function getTagID($strid)
{
     if(strstr($strid,"id"))
     {
        

    echo chop(substr($strid,strpos($strid,'id')+4),'">');

     }
     else
      echo 'The Tag does not have id';

}
getTagID('<div id="container">');





?>