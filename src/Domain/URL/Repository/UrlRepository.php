<?php

namespace App\Domain\URL\Repository;

use Illuminate\Database\Connection;

/**
 * Repository.
 */
class UrlRepository
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
     * Insert url row.
     *
     * @param array $url The url
     *
     * @return int The new ID
     */
    public function insert(array $data): int
    {
        $values = [
            'url' => $data['url'],
            'shortUrl' => $data['shortUrl'],
            'user' => $data['userId']
        ];

        return $this->connection->table('url')->insertGetId($values);
    }
    //
    // /**
    //  * Update url row.
    //  *
    //  * @param array $url The url
    //  *
    //  * @return int The new ID
    //  */
    // public function update(array $data): int
    // {
    //     $values = ['hits' => $data['name']];
    //
    //     return $this->connection->table('url')->update($values);
    // }
}
