<?php

namespace App\Domain\Stats\Repository;

use Illuminate\Database\Connection;

/**
 * Repository.
 */
class StatsRepository
{
    /**
     * @var Connection
     */
    private $connection;

    /**
     * The constructor.
     *
     * @param Connection $connection The database connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }
    /**
     * Get url row.
     *
     * @param array $data The url identifier
     *
     * @return UrlData
     */
    public function getById(array $data)
    {
        return $this->connection->table('url')->find($data['id']);
    }
}
