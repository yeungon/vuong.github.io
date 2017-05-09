<?php
$xmlDoc=new DOMDocument();
$xmlDoc->load("https://yeungon.github.io/xml/links.xml");

$x=$xmlDoc->getElementsByTagName('id');

//get the q parameter from URL
$q=$_GET["q"];

//lookup all links from the xml file if length of q>0
if (strlen($q)>0) {
  $hint="";
  for($i=0; $i<($x->length); $i++) {
    $y=$x->item($i)->getElementsByTagName('title');
    $z=$x->item($i)->getElementsByTagName('content');
    if ($y->item(0)->nodeType==1) {


      //find a link matching the search text
      if (stristr($y->item(0)->childNodes->item(0)->nodeValue,$q)) {
        if ($hint=="") {
          $hint= $z->item(0)->childNodes->item(0)->nodeValue;
          $y->item(0)->childNodes->item(0)->nodeValue ;
        } else {
          $hint=$hint;
          $z->item(0)->childNodes->item(0)->nodeValue;

          $y->item(0)->childNodes->item(0)->nodeValue ;
        }
      }
    }
  }
}

// Set output to "no suggestion" if no hint was found
// or to the correct values
if ($hint=="") {
  $response="Không tìm thấy";
} else {
  $response=$hint;
}

//output the response
echo $response;

/*If there is any text sent from the JavaScript (strlen($q) > 0), the following happens:

Load an XML file into a new XML DOM object
Loop through all <title> elements to find matches from the text sent from the JavaScript
Sets the correct url and title in the "$response" variable. If more than one match is found, all matches are added to the variable
If no matches are found, the $response variable is set to "no suggestion"
*/
?>
