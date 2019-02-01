<?php
declare(strict_types=1);

namespace Eos\ArangoDBConnector\Connection;

use ArangoDBClient\Connection;

/**
 * @author Philipp Marien <marien@eosnewmedia.de>
 */
interface ConnectionFactoryInterface
{
    /**
     * @return Connection
     */
    public function create(): Connection;
}
