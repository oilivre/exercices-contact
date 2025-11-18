<?php

/*
$eleves  = [
    ["nom" => "Alice", "notes"=> [15,14,16]],
    ["nom" => "Bob", "notes"=> [12,10,11]],
    ["nom" => "Claire", "notes"=> [18,17,16]]
];

foreach($eleves as $student){
    $moyenne=0;
    for($i=0; $i<=3; $i++){
        $moyenne+=$student["notes"][$i];
    }
    $moyenne =$moyenne/3;
    echo ($student["nom"] . " avec une moyenne de " . $moyenne  );
}*/




/*
function strcontain($string, $chaine){
    $token = 0;
    for($i=0;$i<=strlen($chaine);$i++){
        if ($chaine[$i]==$string[$token]){
            $token++;
        }
        if($token ==strlen($string) ){
            return "Yes";
        }
    }
    return "No";
}

echo strcontain("ABC", "ABCEFG")*/

$contact = fopen("table.txt", "r");
$status =1;
while(!feof($contact)){
    if($status == 1){
        $status++;
    } else {
    $line = fgets($contact);
    $pieces = explode(" ", $line) ;
    for ($i=0; $i<=count($pieces)-1 ;$i++){
        if($i=!0 && $piece[0]*$i ==$piece[$i]){
            echo $piece[0]*$i;
        } else {
            echo  $piece[$i];
        }
    }
    }
    echo "<br>";
}

?>