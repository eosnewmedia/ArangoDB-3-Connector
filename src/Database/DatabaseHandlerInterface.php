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
    public function createDatabase(?string $user = null, ?string $password = null): void;

    /**
     * @param string|null $user
     * @param string|null $password
     */
    public function removeDatabase(?string $user = null, ?string $password = null): void;
}
