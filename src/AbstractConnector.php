<?php
declare(strict_types=1);

namespace Eos\ArangoDBConnector;

use ArangoDBClient\Connection;
use Eos\ArangoDBConnector\Connection\ConnectionFactoryInterface;

/**
 * @author Philipp Marien <marien@eosnewmedia.de>
 */
abstract class AbstractConnector
{
    /**
     * @var ConnectionFactoryInterface
     */
    private $connectionFactory;
    /**
     * @var Connection
     */
    private $connection;

    /**
     * @param ConnectionFactoryInterface $connectionFactory
     */
    public function __construct(ConnectionFactoryInterface $connectionFactory)
    {
        $this->connectionFactory = $connectionFactory;
    }

    /**
     * @return Connection
     */
    protected function getConnection(): Connection
    {
        if (!$this->connection) {
            $this->connection = $this->connectionFactory->create();
        }

        return $this->connection;
    }
}
