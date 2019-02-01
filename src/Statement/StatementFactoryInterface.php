<?php
declare(strict_types=1);

namespace Eos\ArangoDBConnector\Statement;

use ArangoDBClient\Statement;

/**
 * @author Philipp Marien <marien@eosnewmedia.de>
 */
interface StatementFactoryInterface
{
    /**
     * @param array $data
     * @return Statement
     */
    public function create(array $data): Statement;

    /**
     * @param string $query
     * @param array $bindVars
     * @return Statement
     */
    public function createQuery(string $query, array $bindVars = []): Statement;
}
