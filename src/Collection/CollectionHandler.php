<?php
declare(strict_types=1);

namespace Eos\ArangoDBConnector\Collection;

use ArangoDBClient\Collection;
use ArangoDBClient\Exception;
use Eos\ArangoDBConnector\Connection\ConnectionFactoryInterface;

/**
 * @author Philipp Marien <marien@eosnewmedia.de>
 */
class CollectionHandler extends \ArangoDBClient\CollectionHandler implements CollectionHandlerInterface
{
    /**
     * @param ConnectionFactoryInterface $connectionFactory
     */
    public function __construct(ConnectionFactoryInterface $connectionFactory)
    {
        parent::__construct($connectionFactory->create());
    }

    /**
     * @param string $name
     * @param bool $overwrite
     * @param bool $waitForSync
     * @throws Exception
     */
    public function createDocumentCollection(string $name, bool $overwrite = false, bool $waitForSync = false): void
    {
        if ($overwrite && $this->has($name)) {
            $this->drop($name);
        }

        $collection = new Collection($name);
        $collection->setType(Collection::TYPE_DOCUMENT);
        $collection->setWaitForSync($waitForSync);

        $this->create($collection);
    }

    /**
     * @param string $name
     * @param bool $overwrite
     * @param bool $waitForSync
     * @throws Exception
     */
    public function createEdgeCollection(string $name, bool $overwrite = false, bool $waitForSync = false): void
    {
        if ($overwrite && $this->has($name)) {
            $this->drop($name);
        }

        $collection = new Collection($name);
        $collection->setType(Collection::TYPE_EDGE);
        $collection->setWaitForSync($waitForSync);

        $this->create($collection);
    }

    /**
     * @param string $collection
     * @param string $type
     * @param array $fields
     * @param array $options
     * @throws Exception
     */
    public function createIndex(string $collection, string $type, array $fields, array $options = []): void
    {
        $this->index($collection, $type, $fields, null, $options);
    }

    /**
     * @param string $name
     * @throws Exception
     */
    public function removeCollection(string $name): void
    {
        if ($this->has($name)) {
            $this->drop($name);
        }
    }
}
