<?php
function get_smallest(array $arr): int
{
    $smallestIndex = 0;
    $smallest = $arr[$smallestIndex];

    foreach ($arr as $i => $item) {
        if ($item < $smallest) {
            $smallest = $item;
            $smallestIndex = $i;
        }
    }

    return $smallestIndex;
}

function selection_sort(array $arr): array
{
    $result = [];
    $max = count($arr);

    for ($i = 0; $i < $max; $i++) {
        $j = get_smallest($arr);
        $result[] = $arr[$j];
        unset($arr[$j]);
        $arr = array_values($arr);
    }

    return $result;
}

print_r(selection_sort([3, 5, 7, 1, 2, 4, 8, 6, 9]));