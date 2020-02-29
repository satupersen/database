<?php

namespace Satupersen\Database\Events;

use Satupersen\Contracts\Database\Events\MigrationEvent as MigrationEventContract;
use Satupersen\Database\Migrations\Migration;

abstract class MigrationEvent implements MigrationEventContract
{
    /**
     * An migration instance.
     *
     * @var \Satupersen\Database\Migrations\Migration
     */
    public $migration;

    /**
     * The migration method that was called.
     *
     * @var string
     */
    public $method;

    /**
     * Create a new event instance.
     *
     * @param  \Satupersen\Database\Migrations\Migration  $migration
     * @param  string  $method
     * @return void
     */
    public function __construct(Migration $migration, $method)
    {
        $this->method = $method;
        $this->migration = $migration;
    }
}
