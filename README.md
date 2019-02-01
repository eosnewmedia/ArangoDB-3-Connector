eos/arango-db-3-connector
=========================
Factory and interface wrappers for simpler and cleaner usage of `triagens/arangodb`.

## Installation

```bash
composer req eos/arango-db-3-connector
```

## Usage

The simplest way to use this library is to create an instance of `ArangoDB` which implements `ArangoDBInterface`.

```php
<?php

$arangoDB = \Eos\ArangoDBConnector\ArangoDB::create(
    ['tcp://127.0.0.1:8529'],
    'your_database_name',
    'your_database_user',
    'your_database_password',
    [
        \ArangoDBClient\ConnectionOptions::OPTION_WAIT_SYNC => true, // your connection configuration
    ]
);

// create your database
$arangoDB->database()->createDatabase();

// create your first collection
$arangoDB->collections()->createDocumentCollection('example');

// create your first document
$arangoDB->execute('INSERT { name: @name } INTO example', ['name'=>'Test']);

// for custom statements use: $arangoDB->statements()->createStatement([...]);

```

### Connections
Connections will be created by an instance of `ConnectionFactoryInterface` if their are needed.

The default implementation of `ConnectionFactoryInterface` is `ConnectionFactory`:

```php
<?php

$connectionFactory = new \Eos\ArangoDBConnector\Connection\ConnectionFactory(
    ['tcp://127.0.0.1:8529'],
    'your_database_name',
    'your_database_user',
    'your_database_password',
    [
        \ArangoDBClient\ConnectionOptions::OPTION_WAIT_SYNC => true, // your connection configuration
    ]
);

```

### Database Management
Your database could be managed with an instance of `DatabaseHandlerInterface`.

The default implementation of `DatabaseHandlerInterface` is `DatabaseHandler`:

```php
<?php

/** @var \Eos\ArangoDBConnector\Connection\ConnectionFactoryInterface $connectionFactory */

/** @var \Eos\ArangoDBConnector\Database\DatabaseHandlerInterface $databaseHandler */
$databaseHandler = new \Eos\ArangoDBConnector\Database\DatabaseHandler($connectionFactory);

// create your database (configured in the connection)
$databaseHandler->createDatabase();

// if your database user is not allowed to create a new database, overwrite the configured user for this action:
$databaseHandler->createDatabase('admin_user','admin_password');

// remove your database (configured in the connection)
$databaseHandler->removeDatabase();

// if your database user is not allowed to remove a database, overwrite the configured user for this action:
$databaseHandler->removeDatabase('admin_user','admin_password');

```

### Collection Management
Your collections could be managed with an instance of `CollectionHandlerInterface`.

The default implementation of `CollectionHandlerInterface` is `CollectionHandler`:

```php
<?php

/** @var \Eos\ArangoDBConnector\Connection\ConnectionFactoryInterface $connectionFactory */

/** @var \Eos\ArangoDBConnector\Collection\CollectionHandlerInterface $collectionHandler */
$collectionHandler = new \Eos\ArangoDBConnector\Collection\CollectionHandler($connectionFactory);

// create a document collection
$collectionHandler->createDocumentCollection('your_collection');

// create an edge collection
$collectionHandler->createEdgeCollection('your_collection');

// create an index for a collection
$collectionHandler->createIndex('your_collection','hash',['your_field']);

// remove a collection
$collectionHandler->removeCollection('your_collection');

```

### Statements
Your statements could be created by an instance of `StatementFactoryInterface`.

The default implementation of `StatementFactoryInterface` is `StatementFactory`:

```php
<?php

/** @var \Eos\ArangoDBConnector\Connection\ConnectionFactoryInterface $connectionFactory */

/** @var \Eos\ArangoDBConnector\Statement\StatementFactoryInterface $statementFactory */
$statementFactory = new \Eos\ArangoDBConnector\Statement\StatementFactory($connectionFactory);

// create a generic statement
$statement =$statementFactory->createStatement(['query'=>'FOR document IN your_collection RETURN document']);
$cursor = $statement->execute();

// create query statement
$statement =$statementFactory->createQueryStatement('INSERT { name: @name } INTO your_collection', ['name'=>'Test']);
$statement->execute();

```
