<?php


class Vertex
{
    protected ?Vertex $prev = null;

    protected int $index;

    public function __construct(int $index)
    {
        $this->index = $index;
    }

    /**
     * @param Vertex $prev
     *
     * @return Vertex
     */
    public function setPrev(Vertex $prev): Vertex
    {
        $this->prev = $prev;
        return $this;
    }

    /**
     * @return Vertex|null
     */
    public function getPrev(): ?Vertex
    {
        return $this->prev;
    }

    /**
     * @return int
     */
    public function getIndex(): int
    {
        return $this->index;
    }
}