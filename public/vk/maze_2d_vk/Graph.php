<?php
include_once "Map.php";
include_once "Node.php";

/**
 * Class Graph
 */
class Graph
{
    protected array $graph;

    /**
     * Graph constructor.
     *
     * @param array $graph
     */
    public function __construct(array $graph)
    {
        $this->graph = $graph;
    }

    /**
     * @param int $start
     * @param int $finish
     *
     * @return bool
     */
    public function pathExists(int $start, int $finish): bool
    {
        $stack = [$start => [$start => true]];

        while(count($stack)) {
            $current = array_keys($stack)[count($stack) - 1];
            if ($current === $finish) {
                return true;
            }

            $goingDeep = false;
            foreach ($this->graph[$current] as $neighborIndex) {
                if (!isset($stack[$current][$neighborIndex])) {
                    $stack[$current][$neighborIndex] = true;
                    $stack[$neighborIndex] = $stack[$current];
                    $goingDeep = true;
                    break;
                }
            }

            if (!$goingDeep) {
                array_pop($stack);
            }
        }

        return false;
    }

    /**
     * @param int $start
     * @param int $finish
     *
     * @return array
     */
    public function shortestPath(int $start, int $finish): array
    {
        $path = [];
        $queue = [new Node($start)];
        $passed = [];
        $destination = null;
        foreach ($queue as &$current) {
            $passed[$current->getIndex()] = true;

            if (in_array($finish, $this->graph[$current->getIndex()])) {
                $destination = new Node($finish);
                $destination->setPrev($current);
                break;
            } else {
                foreach ($this->graph[$current->getIndex()] as $neighborIndex) {
                    if (!isset($passed[$neighborIndex])) {
                        $queue[] = (new Node($neighborIndex))->setPrev($current);
                    }
                }
            }
        }

        if ($destination instanceof Node) {
            $current = $destination;
            $path[] = $current->getIndex();
            while($prev = $current->getPrev()) {
                array_unshift($path, $prev->getIndex());
                $current = $prev;
            }
        }

        return $path;
    }

    /**
     * @param int $start
     * @param int $finish
     *
     * @return array
     */
    public function allPaths(int $start, int $finish): array
    {
        $stack = [$start => [$start => true]];
        $paths = [];

        while(count($stack)) {
            $current = array_keys($stack)[count($stack) - 1];
            $goingDeep = false;

            if ($current === $finish) {
                $paths[] = array_keys($stack);
                array_pop($stack);
            } else {
                foreach ($this->graph[$current] as $neighbor) {
                    if (!isset($stack[$current][$neighbor])) {
                        $stack[$current][$neighbor] = true;
                        $stack[$neighbor] = $stack[$current];
                        $goingDeep = true;
                        break;
                    }
                }
            }

            if (!$goingDeep) {
                array_pop($stack);
            }

        }

        return $paths;
    }
}