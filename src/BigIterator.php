<?php

namespace App;

class BigIterator implements \Iterator
{
    /**
     * @var int
     */
    private $position;

    /**
     * @var array
     */
    private $rows;

    /**
     * @var int
     */
    private $offset;

    /**
     * @var RowsLoader
     */
    private $rowsLoader;

    /**
     * @param RowsLoader $rowsLoader
     */
    public function __construct(RowsLoader $rowsLoader)
    {
        $this->position = 0;
        $this->rows = [];
        $this->offset = 0;
        $this->rowsLoader = $rowsLoader;

        $this->loadMoreRows();
    }

    /**
     * @inheritdoc
     */
    public function rewind(): void
    {
        $this->position = 0;
        $this->offset = 0;
        $this->loadMoreRows();
    }

    /**
     * @inheritdoc
     */
    public function current(): array
    {
        return $this->rows[$this->position];
    }

    /**
     * @inheritdoc
     */
    public function key(): int
    {
        return $this->position;
    }

    /**
     * @inheritdoc
     */
    public function next(): void
    {
        ++$this->position;

        if (!$this->valid()) {
            $this->loadMoreRows();
        }
    }

    /**
     * @inheritdoc
     */
    public function valid(): bool
    {
        return isset($this->rows[$this->position]);
    }

    /**
     * @return void
     */
    private function loadMoreRows(): void
    {
        $this->rows = $this->rowsLoader->loadRows($this->offset);
        $this->position = 0;
        $this->offset += count($this->rows);
    }
}
