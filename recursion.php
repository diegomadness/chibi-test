<?php
/**
 * But if you wanted to see recursion - here it is :)
 *
 * I've also made array input instead of string to avoid json_decod-ing it or decoding it
 * through any other way since the goal of the task was to show recursion...or was it not?
 * Anyway, let me know if anything concerns you
 */
$input = [1, 2, [9, 8, "This is text"], 10];

// WRITE CODE HERE
$array = process($input);
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