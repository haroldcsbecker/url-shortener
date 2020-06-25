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

    /**
     * Get url rows.
     *
     * @param void
     *
     * @return array
     */
    public function get(): array
    {
        $result['hits'] = $this->connection->table('url')->sum('hits');
        $result['urlCount'] = $this->connection->table('url')->count();
        $result['topUrls'] = $this->connection->table('url')
            ->select('id', 'hits', 'url', 'shortUrl')
            ->get();

        return $result;
    }
}
