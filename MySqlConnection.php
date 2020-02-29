<?php

namespace Satupersen\Database;

use Doctrine\DBAL\Driver\PDOMySql\Driver as DoctrineDriver;
use Satupersen\Database\Query\Grammars\MySqlGrammar as QueryGrammar;
use Satupersen\Database\Query\Processors\MySqlProcessor;
use Satupersen\Database\Schema\Grammars\MySqlGrammar as SchemaGrammar;
use Satupersen\Database\Schema\MySqlBuilder;

class MySqlConnection extends Connection
{
    /**
     * Get the default query grammar instance.
     *
     * @return \Satupersen\Database\Query\Grammars\MySqlGrammar
     */
    protected function getDefaultQueryGrammar()
    {
        return $this->withTablePrefix(new QueryGrammar);
    }

    /**
     * Get a schema builder instance for the connection.
     *
     * @return \Satupersen\Database\Schema\MySqlBuilder
     */
    public function getSchemaBuilder()
    {
        if (is_null($this->schemaGrammar)) {
            $this->useDefaultSchemaGrammar();
        }

        return new MySqlBuilder($this);
    }

    /**
     * Get the default schema grammar instance.
     *
     * @return \Satupersen\Database\Schema\Grammars\MySqlGrammar
     */
    protected function getDefaultSchemaGrammar()
    {
        return $this->withTablePrefix(new SchemaGrammar);
    }

    /**
     * Get the default post processor instance.
     *
     * @return \Satupersen\Database\Query\Processors\MySqlProcessor
     */
    protected function getDefaultPostProcessor()
    {
        return new MySqlProcessor;
    }

    /**
     * Get the Doctrine DBAL driver.
     *
     * @return \Doctrine\DBAL\Driver\PDOMySql\Driver
     */
    protected function getDoctrineDriver()
    {
        return new DoctrineDriver;
    }
}
