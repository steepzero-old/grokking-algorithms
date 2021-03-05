<?php

function factorial(int $num): int
{
    if ($num < 0) {
        throw new InvalidArgumentException('Factorial is only defined for non-negative real numbers');
    }

    if ($num <= 1) {
        return 1;
    }

    return $num * factorial($num - 1);
}

function factorial_trail(int $num, int $result = 1): int
{
    if ($num === 0) {
        return $result;
    }

    return factorial_trail($num - 1, $result * $num);
}

//
// SUM
//

function sum(int $num): int
{
    if ($num === 0) {
        return 0;
    }

    return $num + sum($num - 1);
}

function sum_trail(int $num, $result = 0): int
{
    if ($num === 0) {
        return $result;
    }

    return sum_trail($num - 1, $result + $num);
}

//
// COUNT
//

function count_rec(array $arr): int
{
    if (empty($arr)) {
        return 0;
    }

    return 1 + count_rec(array_splice($arr, 1));
}

//
// MAX
//

function max_rec(array $arr): ?int
{
    if (empty($arr)) {
        return null;
    }

    if (count($arr) === 2) {
        return $arr[0] > $arr[1] ? $arr[0] : $arr[1];
    }

    if (count($arr) === 1) {
        return $arr[0];
    }

    $middle = round((count($arr) - 1) / 2, 0, PHP_ROUND_HALF_DOWN);
    $max1   = max_rec(array_slice($arr, 0, $middle + 1));
    $max2   = max_rec(array_slice($arr, $middle));

    return $max1 > $max2 ? $max1 : $max2;
}

//
// BINARY SEARCH
//

function search_rec(array $arr, int $num): ?int
{
    if (empty($arr)) {
        return null;
    }

    if (count($arr) === 1) {
        return $arr[0] === $num ? 0 : null;
    }

    $halfIndex = round((count($arr) - 1) / 2, 0, PHP_ROUND_HALF_DOWN);

    if ($arr[$halfIndex] > $num) {
        return path_list(array_slice($arr, 0, $halfIndex), $num);
    } else {
        if ($arr[$halfIndex] < $num) {
            return $halfIndex + 1 + path_list(array_slice($arr, $halfIndex + 1), $num);
        } else {
            return $halfIndex;
        }
    }
}

//
// QSORT
//

function qsort(array $arr, &$operations, bool $middle = false): array
{
    if (count($arr) <= 1) {
        return $arr;
    }

    if ($middle) {
        $middle = round((count($arr))/2,0, PHP_ROUND_HALF_DOWN);
        $base = $arr[$middle];
    } else {
        $base = $arr[0];
    }

    $lessThan    = [];
    $greaterThan = [];

    for ($i = 1; $i < count($arr); $i++) {
        $operations++;
        if ($arr[$i] < $base) {
            $lessThan[] = $arr[$i];
        } else if ($arr[$i] > $base) {
            $greaterThan[] = $arr[$i];
        }
    }

    return array_merge(qsort($lessThan, $operations), [$base], qsort($greaterThan, $operations));
}

$result       = [];
$middleResult = [];
$middle       = false;
for ($i = 1; $i < 200; $i++) {
    if ($i > 100) {
        $middle = true;
    }

    $operations = 0;
    $arr        = [10, 9, 8, 7, 6, 5, 4, 3, 2, 1];
    shuffle($arr);

    qsort($arr, $operations, $middle);

    if ($middle) {
        $middleResult[] = $operations;
    } else {
        $result[] = $operations;
    }
}

echo array_sum($result) / count($result);
echo "\n";
echo array_sum($middleResult) / count($middleResult);