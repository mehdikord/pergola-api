<?php
/*
 * All Core functions is here ...
 */

function helper_core_code_generator($unique = 1, $count = 10): string
{
    $length = $count - strlen($unique) ;
    $start =1;
    $end = 9;
    for($i=1;$i<$length;$i++){
        $start.=0;
        $end.=9;
    }
    return $unique.random_int($start,$end);
}

function helper_core_array_equal($array_one, $array_two): bool
{

    if (count($array_one) !== count($array_two)) {
        return false;
    }

    foreach ($array_one as $item) {
        $found = false;

        foreach ($array_two as $key => $value) {
            if ($item['id'] === $value['id'] && $item['value'] === $value['value']) {
                $found = true;
                unset($array_two[$key]);
                break;
            }
        }
        if (!$found) {
            return false;
        }
    }
    return true;
}




