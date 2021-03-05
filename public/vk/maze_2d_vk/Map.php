<?php


class Map
{
    protected array  $map;
    protected string $pass;
    protected string $wall;
    protected int    $mapHeight;
    protected int    $mapWidth;

    public function __construct(array $map, string $pass = '_', string $wall = 'X')
    {
        $this->map       = $map;
        $this->pass      = $pass;
        $this->wall      = $wall;
        $this->mapHeight = count($map);
        $this->mapWidth  = count($map[0]);
    }

    public function adjacencyList(): array
    {
        $graph = [];

        for ($y = 0; $y < $this->mapHeight; $y++) {
            for ($x = 0; $x < $this->mapWidth; $x++) {
                if ($this->isReachable($x, $y)) {
                    $graph[$this->getGraphIndex($x, $y)] = $this->reachableNeighbors($x, $y);
                }
            }
        }

        return $graph;
    }

    protected function reachableNeighbors(int $x, int $y): array
    {
        $reachable = [];
        // left
        if ($this->isReachable($x-1, $y)) {
            $reachable[] = $this->getGraphIndex($x - 1, $y);
        }

        // right
        if ($this->isReachable($x+1, $y)) {
            $reachable[] = $this->getGraphIndex($x+1, $y);
        }

        // up
        if ($this->isReachable($x, $y-1)) {
            $reachable[] = $this->getGraphIndex($x, $y-1);
        }

        // down
        if ($this->isReachable($x, $y+1)) {
            $reachable[] = $this->getGraphIndex($x, $y+1);
        }

        return $reachable;
    }

    protected function isReachable(int $x, int $y): bool
    {
        return isset($this->map[$y][$x]) && $this->map[$y][$x] === $this->pass;
    }

    public function getGraphIndex(int $x, int $y): int
    {
        return $x + ($y * $this->mapWidth);
    }
}