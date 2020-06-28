<?php

namespace App\Domain\User\Repository;

use Illuminate\Database\Connection;

/**
 * Repository.
 */
class UserRepository
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
     * Insert user row.
     *
     * @param array $user The user
     *
     * @return int The new ID
     */
    public function insert(array $user): int
    {
        $values = ['name' => $user['id']];

        return $this->connection->table('user')->insertGetId($values);
    }

    /**
     * Delete user row.
     *
     * @param array $data The user identifier
     *
     * @return void
     */
    public function delete(array $data): void
    {
        $this->connection->table('user')->delete($data['userId']);
    }
}
