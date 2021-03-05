<?php

include_once "Map.php";
include_once "Graph.php";

$mapData = [
    ['_', '_', '_', '_', '_'],
    ['X', 'X', 'X', 'X', '_'],
    ['_', '_', 'X', '_', '_'],
    ['X', 'X', 'X', '_', 'X'],
    ['_', '_', '_', '_', '_'],
];

/**
 * 1. Понять есть ли путь от А до Б
 * 2. Вывести путь от А до Б
 * 3. Вывести путь от А до Б в формате "Право -> Вниз -> Влево -> Вверх"
 */

/**
 * Конвертируем лабиринт в граф (список смежности)
 */

$map       = new Map($mapData, '_', 'X');
$graphData = $map->adjacencyList();

/**
 * Проверяем существует ли путь от (x1, y1) до (x2, y2)
 */

$graph = new Graph($graphData);
$start = $map->getGraphIndex(0, 0);
$finish = $map->getGraphIndex(4, 4);
var_dump($graph->pathExists($start, $finish));

print_r($graph->allPaths($start, $finish));
print_r($graph->shortestPath($start, $finish));