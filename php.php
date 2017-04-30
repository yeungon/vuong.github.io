<?php

$nam = array(
    1990,
    1991,
    1992,
    1993,
    1994,
    1995
);
  
//Dùng foreach xuất ra các năm trong $nam
//foreach ($nam as $value){
    //echo $value;
//}


//Dùng foreach xuất ra các năm trong $nam
foreach ($nam as $chimuc => $giatri){ //array as &key==> &value
    echo $chimuc . ' => ' . $giatri.'<br/>';


}


$mang = array('Trường', 'Sa', 'Hoàng', 'Sa', 'Là', 'Của', 'Việt', 'Nam');


// Kieu foreach so 1

foreach ( $mang AS $item ) {
    echo $item.'<br/>';
}

// kieu foreach so 2

foreach ( $mang AS $item ) {
    $item = strtoupper($item);
}
echo '<pre>';
print_r($mang);


// to bold the value

foreach ( $mang AS & $item ) {
    $item = strtoupper($item);
}
echo '<pre>';
print_r($mang);

//kieu lap khac

foreach ( $mang AS $item ) {
   $mang[] = $item;
}
echo '<pre>';
print_r($mang);


// json function encode

$arr = ["name" => "Jonh Doe", "job" => "PHP Developer"];
echo json_encode($arr).'<br/>';


echo "============".'<br/>';
// jason fuction decode
$jsonString = '{ "lang": "PHP", "type": "scripting", "birthYear": "1995" }';

$obj = json_decode($jsonString);

var_dump($obj);


?>