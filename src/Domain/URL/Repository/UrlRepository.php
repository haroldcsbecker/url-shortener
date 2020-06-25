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

    /**
     * Delete url row.
     *
     * @param array $data The url identifier
     *
     * @return void
     */
    public function delete(array $data): void
    {
        $this->connection->table('url')->delete($data['id']);
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
     * Update url row.
     *
     * @param array $url The url
     *
     */
    public function update(array $data)
    {
        $values = ['hits' => $data['hits'] + 1];
        $this->connection->table('url')
            ->where(['id' => $data['id']])
            ->update($values);
    }
}
