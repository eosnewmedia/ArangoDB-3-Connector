<?php
declare(strict_types=1);

namespace Eos\ArangoDBConnector\Database;

/**
 * @author Philipp Marien <marien@eosnewmedia.de>
 */
interface DatabaseHandlerInterface
{
    /**
     * @param string|null $user
     * @param string|null $password
     */
    public function create(?string $user = null, ?string $password = null): void;

    /**
     * @param string|null $user
     * @param string|null $password
     */
    public function remove(?string $user = null, ?string $password = null): void;
}
