<?php
declare(strict_types=1);

namespace Eos\ArangoDBConnector\Statement;

use ArangoDBClient\Exception;
use ArangoDBClient\Statement;
use Eos\ArangoDBConnector\AbstractConnector;

/**
 * @author Philipp Marien <marien@eosnewmedia.de>
 */
class StatementFactory extends AbstractConnector implements StatementFactoryInterface
{
    /**
     * @param array $data
     * @return Statement
     * @throws Exception
     */
    public function createStatement(array $data): Statement
    {
        return new Statement($this->getConnection(), $data);
    }

    /**
     * @param string $query
     * @param array $bindVars
     * @return Statement
     * @throws Exception
     */
    public function createQueryStatement(string $query, array $bindVars = []): Statement
    {
        return new Statement(
            $this->getConnection(),
            [
                Statement::ENTRY_QUERY => $query,
                Statement::ENTRY_BINDVARS => $bindVars,
            ]
        );
    }
}
