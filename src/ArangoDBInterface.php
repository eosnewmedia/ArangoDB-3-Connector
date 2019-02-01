<?php
declare(strict_types=1);

namespace Eos\ArangoDBConnector;

use ArangoDBClient\Cursor;
use Eos\ArangoDBConnector\Collection\CollectionHandlerInterface;
use Eos\ArangoDBConnector\Database\DatabaseHandlerInterface;
use Eos\ArangoDBConnector\Statement\StatementFactoryInterface;

/**
 * @author Philipp Marien <marien@eosnewmedia.de>
 */
interface ArangoDBInterface
{
    /**
     * @return DatabaseHandlerInterface
     */
    public function database(): DatabaseHandlerInterface;

    /**
     * @return CollectionHandlerInterface
     */
    public function collections(): CollectionHandlerInterface;

    /**
     * @return StatementFactoryInterface
     */
    public function statements(): StatementFactoryInterface;

    /**
     * @param string $query
     * @param array $bindVars
     * @return Cursor
     */
    public function execute(string $query, array $bindVars = []): Cursor;
}
