<?php

namespace App;

class MysqlRowsLoader implements RowsLoader
{
    /**
     * @var \mysqli
     */
    private $db;

    /**
     * @var string
     */
    private $tableName;

    /**
     * @param \mysqli $db
     * @param string $tableName
     */
    public function __construct(\mysqli $db, string $tableName)
    {
        $this->db = $db;
        $this->tableName = $this->db->escape_string($tableName);
    }

    /**
     * @param int $offset
     * @param int $limit
     * @return array
     * @throws QueryException
     */
    public function loadRows(int $offset = self::OFFSET, int $limit = self::LIMIT): array
    {
        $query = <<<SQL
SELECT *
FROM `{$this->tableName}`
LIMIT {$offset}, {$limit}
SQL;
        $result = $this->db->query($query);
        if ($result === false) {
            throw new QueryException();
        }

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
