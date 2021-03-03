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
    $vertex = $destination;

    while ($prev = $vertex->getPrev()) {
        $reversedPath[] = $prev;
        $vertex = $prev;
    }

    return $reversedPath;
}

$start  = 0;
$finish = 6;
print_r(array_map(fn($vertex) => $vertex->getIndex(), path_length_wide_2($graph, $start, $finish)));