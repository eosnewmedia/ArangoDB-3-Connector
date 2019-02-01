<?php
declare(strict_types=1);

namespace Eos\ArangoDBConnector\Collection;

/**
 * @author Philipp Marien <marien@eosnewmedia.de>
 */
interface CollectionHandlerInterface
{
    public const INDEX_FULLTEXT = 'fulltext';
    public const INDEX_GEO = 'geo';
    public const INDEX_HASH = 'hash';
    public const INDEX_PERSISTENT = 'persistent';
    public const INDEX_SKIP_LIST = 'skiplist';

    public const INDEX_OPTION_MIN_LENGTH = 'minLength';
    public const INDEX_OPTION_UNIQUE = 'unique';
    public const INDEX_OPTION_GEO_JSON = 'geoJson';
    public const INDEX_OPTION_SPARSE = 'sparse';

    /**
     * @param string $name
     * @param bool $overwrite
     * @param bool $waitForSync
     */
    public function createDocumentCollection(string $name, bool $overwrite = false, bool $waitForSync = false): void;

    /**
     * @param string $name
     * @param bool $overwrite
     * @param bool $waitForSync
     */
    public function createEdgeCollection(string $name, bool $overwrite = false, bool $waitForSync = false): void;

    /**
     * @param string $collection
     * @param string $type
     * @param array $fields
     * @param array $options
     */
    public function createIndex(string $collection, string $type, array $fields, array $options = []): void;

    /**
     * @param string $name
     */
    public function removeCollection(string $name): void;
}
