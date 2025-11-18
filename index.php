<?php 

$contact = fopen("contact.txt", "r");
$contactbase =["Alice Dupont","John Doe", "Jean Martin"];

$token =0;
while(!feof($contact)){
    $temp = trim(fgets($contact));
    foreach($contactbase as $element){
        if($element==$temp){
            $token ++;
        }
    }
    if($token==0){
        array_push($contactbase, $temp);
    }
    $token = 0;
}

print_r($contactbase);


?>