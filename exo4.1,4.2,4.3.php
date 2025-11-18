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


$contacte = fopen("table.txt", "r");
$status = 1;
while(!feof($contacte)){
    if($status == 1){
        $status++;
        print_r(fgets($contacte));
    }else{
        $ligne = explode(" ", fgets($contacte));
        for ($i = 0; $i<=count($ligne)-1 ; $i++){
            if($i != 0 && $ligne[0]*$i !=$ligne[$i]){
                print_r($ligne[0]*$i. " ");
            }else{
                print_r($ligne[$i]." ");
            }}
        echo "<br>";
    }
};
 
?>
