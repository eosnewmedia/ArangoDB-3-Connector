<?php
declare(strict_types=1);

namespace Eos\ArangoDBConnector\Connection;

use ArangoDBClient\Connection;
use ArangoDBClient\ConnectionOptions;
use ArangoDBClient\Exception;

/**
 * @author Philipp Marien <marien@eosnewmedia.de>
 */
class ConnectionFactory implements ConnectionFactoryInterface
{
    /**
     * @var array
     */
    private $options;

    /**
     * @param array $servers
     * @param string $database
     * @param string $username
     * @param string $password
     * @param array $options
     */
    public function __construct(
        array $servers,
        string $database,
        string $username,
        string $password,
        array $options = []
    ) {
        $this->options = $options;
        $this->options[ConnectionOptions::OPTION_ENDPOINT] = $servers;
        $this->options[ConnectionOptions::OPTION_DATABASE] = $database;
        $this->options[ConnectionOptions::OPTION_AUTH_USER] = $username;
        $this->options[ConnectionOptions::OPTION_AUTH_PASSWD] = $password;
    }

    /**
     * @return Connection
     * @throws Exception
     */
    public function create(): Connection
    {
        return new Connection($this->options);
    }
}
