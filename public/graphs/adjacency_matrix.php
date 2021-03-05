<?php

include_once 'Vertex.php';

$graph = [
    [0, 1, 0, 1, 0, 0, 0],
    [1, 0, 1, 0, 0, 0, 0],
    [0, 1, 0, 0, 1, 1, 1],
    [1, 0, 0, 0, 1, 1, 0],
    [0, 0, 1, 1, 0, 0, 0],
    [0, 0, 1, 1, 0, 0, 0],
    [0, 0, 1, 0, 0, 0, 0]
];

function path_length_wide_2(array $graph, int $start, int $finish): array
{
    $destination = new Vertex($finish);
    $origin      = new Vertex($start);
    $passed      = [];
    $queue       = [
        [$origin]
    ];

    foreach ($queue as $step => &$vertices) {
        foreach ($vertices as $vertex) {

            $passed[$vertex->getIndex()] = true;

            if ($graph[$vertex->getIndex()][$destination->getIndex()]) {
                $destination->setPrev($vertex);
                break(2);
            }

            $neighbors = [];
            foreach ($graph[$vertex->getIndex()] as $neighborIndex => $exists) {
                if ($exists && !isset($passed[$neighborIndex])) {
                    $neighbors[] = (new Vertex($neighborIndex))->setPrev($vertex);
                }
            }

            $nextStep = $step + 1;
            if (!isset($queue[$nextStep])) {
                $queue[$nextStep] = [];
            }
            $queue[$nextStep] = [...$queue[$nextStep], ...$neighbors];
        }
    }

    $reversedPath = [$destination];
    $vertex       = $destination;

    while ($prev = $vertex->getPrev()) {
        $reversedPath[] = $prev;
        $vertex         = $prev;
    }

    return $reversedPath;
}

function path_list_rec(array $graph, int $start, int $finish): array
{
    $stack  = [$start => [$start => true]];
    $result = [];

    while (count($stack)) {
        $current = array_keys($stack)[count($stack) - 1];

        if ($current === $finish) {
            $result[] = array_keys($stack);
            array_pop($stack);
        } else {
            $goingDeep = false;
            foreach ($graph[$current] as $neighborIndex => $exists) {
                if ($exists && !isset($stack[$current][$neighborIndex])) {
                    $stack[$current][$neighborIndex] = true;
                    $stack[$neighborIndex]           = $stack[$current];
                    $goingDeep                       = true;
                    break;
                }
            }

            if (!$goingDeep) {
                array_pop($stack);
            }
        }
    }

    return $result;
}

$start  = 0;
$finish = 6;
$paths  = path_list_rec($graph, $start, $finish);

print_r($paths);