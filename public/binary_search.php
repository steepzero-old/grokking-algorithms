<?php
function binary_search(array $arr, int $number): ?int
{
    $result = null;
    $low    = 0;
    $high   = count($arr) - 1;

    while ($low <= $high && is_null($result)) {

        $guess = round((($low + $high) / 2), 0, PHP_ROUND_HALF_DOWN);

        if ($arr[$guess] > $number) {
            $high = $guess - 1;
        } else if ($arr[$guess] < $number) {
            $low = $guess + 1;
        } else {
            $result = $guess;
        }

    }

    return $result;
}

$arr = [
    1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21
];

var_dump(binary_search($arr, 0));