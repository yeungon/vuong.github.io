Preparing for new project:collocation dictionary (04/MAY/2017:Vuong)


How to convert from array to XML/JSON




(
    ['total_stud']=> 500
    [0] => Array
        (
            [student] => Array
                (
                    [id] => 1
                    [name] => abc
                    [address] => Array
                        (
                            [city]=>Pune
                            [zip]=>411006
                        )                       
                )
        )
    [1] => Array
        (
            [student] => Array
                (
                    [id] => 2
                    [name] => xyz
                    [address] => Array
                        (
                            [city]=>Mumbai
                            [zip]=>400906
                        )   
                )

        )
)
generated XML would be as:

<?xml version="1.0"?>
<student_info>
    <total_stud>500</total_stud>
    <student>
        <id>1</id>
        <name>abc</name>
        <address>
            <city>Pune</city>
            <zip>411006</zip>
        </address>
    </student>
    <student>
        <id>1</id>
        <name>abc</name>
        <address>
            <city>Mumbai</city>
            <zip>400906</zip>
        </address>
    </student>
</student_info>
PHP snippet

<?php
// function defination to convert array to xml
function array_to_xml( $data, &$xml_data ) {
    foreach( $data as $key => $value ) {
        if( is_numeric($key) ){
            $key = 'item'.$key; //dealing with <0/>..<n/> issues
        }
        if( is_array($value) ) {
            $subnode = $xml_data->addChild($key);
            array_to_xml($value, $subnode);
        } else {
            $xml_data->addChild("$key",htmlspecialchars("$value"));
        }
     }
}

// initializing or creating array
$data = array('total_stud' => 500);

// creating object of SimpleXMLElement
$xml_data = new SimpleXMLElement('<?xml version="1.0"?><data></data>');

// function call to convert array to xml
array_to_xml($data,$xml_data);

//saving generated xml file; 
$result = $xml_data->asXML('/file/path/name.xml');

?>
Documentation on SimpleXMLElement::asXML used in this snippet


+++++++++++++++++



3
down vote
accepted
This works for associative arrays.

    function array2xml($array, $node_name="root") {
    $dom = new DOMDocument('1.0', 'UTF-8');
    $dom->formatOutput = true;
    $root = $dom->createElement($node_name);
    $dom->appendChild($root);

    $array2xml = function ($node, $array) use ($dom, &$array2xml) {
        foreach($array as $key => $value){
            if ( is_array($value) ) {
                $n = $dom->createElement($key);
                $node->appendChild($n);
                $array2xml($n, $value);
            }else{
                $attr = $dom->createAttribute($key);
                $attr->value = $value;
                $node->appendChild($attr);
            }
        }
    };

    $array2xml($root, $array);

    return $dom->saveXML();
}



http://stackoverflow.com/questions/1397036/how-to-convert-array-to-simplexml

http://stackoverflow.com/questions/9152176/convert-an-array-to-xml-or-json

