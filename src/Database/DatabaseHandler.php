<?php
declare(strict_types=1);

namespace Eos\ArangoDBConnector\Database;

use ArangoDBClient\ConnectionOptions;
use ArangoDBClient\Exception;
use Eos\ArangoDBConnector\AbstractConnector;

/**
 * @author Philipp Marien <marien@eosnewmedia.de>
 */
class DatabaseHandler extends AbstractConnector implements DatabaseHandlerInterface
{
    /**
     * @param string|null $user
     * @param string|null $password
     * @throws Exception
     */
    public function create(?string $user = null, ?string $password = null): void
    {
        $connection = $this->getConnection();
        $database = $connection->getDatabase();

        $this->modifyConnection($connection, $user, $password);

        \ArangoDBClient\Database::create($connection, $database);
    }

    /**
     * @param string|null $user
     * @param string|null $password
     * @throws Exception
     */
    public function remove(?string $user = null, ?string $password = null): void
    {
        $connection = $this->getConnection();
        $database = $connection->getDatabase();

        $this->modifyConnection($connection, $user, $password);

        \ArangoDBClient\Database::delete($connection, $database);
    }

    /**
     * @param \ArangoDBClient\Connection $connection
     * @param string|null $user
     * @param string|null $password
     * @throws \ArangoDBClient\ClientException
     */
    private function modifyConnection(\ArangoDBClient\Connection $connection, ?string $user, ?string $password): void
    {
        $connection->setDatabase('_system');

        if ($user) {
            $connection->setOption(ConnectionOptions::OPTION_AUTH_USER, $user);
            $connection->setOption(ConnectionOptions::OPTION_AUTH_PASSWD, '');
        }

        if ($password) {
            $connection->setOption(ConnectionOptions::OPTION_AUTH_PASSWD, $password);
        }
    }
}
