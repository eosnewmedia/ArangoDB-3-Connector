<?php
declare(strict_types=1);

namespace Eos\ArangoDBConnector;

use ArangoDBClient\Cursor;
use ArangoDBClient\Exception;
use Eos\ArangoDBConnector\Collection\CollectionHandler;
use Eos\ArangoDBConnector\Collection\CollectionHandlerInterface;
use Eos\ArangoDBConnector\Connection\ConnectionFactory;
use Eos\ArangoDBConnector\Database\DatabaseHandler;
use Eos\ArangoDBConnector\Database\DatabaseHandlerInterface;
use Eos\ArangoDBConnector\Statement\StatementFactory;
use Eos\ArangoDBConnector\Statement\StatementFactoryInterface;

/**
 * @author Philipp Marien <marien@eosnewmedia.de>
 */
class ArangoDB implements ArangoDBInterface
{
    /**
     * @var DatabaseHandlerInterface
     */
    private $databaseHandler;

    /**
     * @var CollectionHandlerInterface
     */
    private $collectionHandler;

    /**
     * @var StatementFactoryInterface
     */
    private $statementFactory;

    /**
     * @param DatabaseHandlerInterface $databaseHandler
     * @param CollectionHandlerInterface $collectionHandler
     * @param StatementFactoryInterface $statementFactory
     */
    public function __construct(
        DatabaseHandlerInterface $databaseHandler,
        CollectionHandlerInterface $collectionHandler,
        StatementFactoryInterface $statementFactory
    ) {
        $this->databaseHandler = $databaseHandler;
        $this->collectionHandler = $collectionHandler;
        $this->statementFactory = $statementFactory;
    }

    /**
     * @param array $servers
     * @param string $database
     * @param string $user
     * @param string $password
     * @param array $options
     * @return ArangoDB
     */
    public static function create(
        array $servers,
        string $database,
        string $user,
        string $password,
        array $options = []
    ): self {
        $connectionFactory = new ConnectionFactory($servers, $database, $user, $password, $options);

        return new self(
            new DatabaseHandler($connectionFactory),
            new CollectionHandler($connectionFactory),
            new StatementFactory($connectionFactory)
        );
    }

    /**
     * @return DatabaseHandlerInterface
     */
    public function database(): DatabaseHandlerInterface
    {
        return $this->databaseHandler;
    }

    /**
     * @return CollectionHandlerInterface
     */
    public function collections(): CollectionHandlerInterface
    {
        return $this->collectionHandler;
    }

    /**
     * @return StatementFactoryInterface
     */
    public function statements(): StatementFactoryInterface
    {
        return $this->statementFactory;
    }

    /**
     * @param string $query
     * @param array $bindVars
     * @return Cursor
     * @throws Exception
     */
    public function execute(string $query, array $bindVars = []): Cursor
    {
        return $this->statements()->createQueryStatement($query, $bindVars)->execute();
    }
}
