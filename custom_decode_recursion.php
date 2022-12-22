<?php
/**
 * Custom decoding for haters of json_decode
 */
$input = '[1, 2, [9, 8, "This is text"], 10]';

// WRITE CODE HERE
$input = customDecode($input);
$array = process($input);
var_dump($array);
//array(6) {
//    [0]=>
//  int(1)
//  [1]=>
//  int(2)
//  [2]=>
//  int(9)
//  [3]=>
//  int(8)
//  [4]=>
//  string(12) "This is text"
//    [5]=>
//  int(10)
//}

function process(array $array): array
{
    $result = [];
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            $result = array_merge($result, process($value));
            continue;
        }
        $value = trim($value);
        if (is_numeric($value)) {
            $result[] = intval($value);
        } else {
            $result[] = str_replace('"', '', $value);
        }
    }
    return $result;
}

function customDecode(string $string)
{
    $result = [];
    $subArray = '';
    $string = trim($string);
    $string = substr($string, 1,-1);
    $exploded = explode(',', $string);
    foreach ($exploded as $value) {
        if (strstr($value, '[') || strlen($subArray)) {
            if (strstr($value, ']')) {
                $subArray .= $value;
                $result = array_merge($result, customDecode($subArray));
                $subArray = '';
            } else {
                $subArray .= $value . ',';
            }
        } else {
            $result[] = $value;
        }
    }
    return $result;
}