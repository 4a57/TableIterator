<?php

namespace App;

interface RowsLoader
{
    const OFFSET = 0;
    const LIMIT = 10000;

    /**
     * @param int $offset
     * @param int $limit
     * @return array
     */
    public function loadRows(int $offset = self::OFFSET, int $limit = self::LIMIT): array;
}
