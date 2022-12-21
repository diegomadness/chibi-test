<?php
/**
 * Actually, my initial solution cares not about any number of arrays inside because of line 8,
 * so your string will be parsed correctly
 */
$input = '[1,2 , [9,8, "This is text"], 10]';

// WRITE CODE HERE
$input = str_replace(['[', ']'], '', $input);
$array = process(explode(',', $input));
var_dump($array);
//array(6) {
//  [0]=>
//  int(1)
//  [1]=>
//  int(2)
//  [2]=>
//  int(9)
//  [3]=>
//  int(8)
//  [4]=>
//  string(12) "This is text"
//  [5]=>
//  int(10)
//}


function process(array $array): array
{
    $result = [];
    foreach ($array as $key => $value) {
        $value = trim($value);
        if (is_numeric($value)) {
            $result[$key] = intval($value);
        } else {
            $result[$key] = str_replace('"', '', $value);
        }
    }
    return $result;
}

