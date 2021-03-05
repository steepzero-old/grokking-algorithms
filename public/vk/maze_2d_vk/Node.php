<?php


class Node
{
    protected int $index;
    protected ?Node $prev = null;

    /**
     * Node constructor.
     *
     * @param int $index
     */
    public function __construct(int $index)
    {
        $this->index = $index;
    }

    /**
     * @param Node $prev
     *
     * @return Node
     */
    public function setPrev(Node $prev): Node
    {
        $this->prev = $prev;
        return $this;
    }

    /**
     * @return $this|null
     */
    public function getPrev(): ?Node
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