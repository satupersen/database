<?php

namespace Satupersen\Database\Schema;

use Satupersen\Support\Str;

class ForeignIdColumnDefinition extends ColumnDefinition
{
    /**
     * The schema builder blueprint instance.
     *
     * @var \Satupersen\Database\Schema\Blueprint
     */
    protected $blueprint;

    /**
     * Create a new foreign ID column definition.
     *
     * @param  \Satupersen\Database\Schema\Blueprint  $blueprint
     * @param  array  $attributes
     * @return void
     */
    public function __construct(Blueprint $blueprint, $attributes = [])
    {
        parent::__construct($attributes);

        $this->blueprint = $blueprint;
    }

    /**
     * Create a foreign key constraint on this column referencing the "id" column of the conventionally related table.
     *
     * @return \Satupersen\Support\Fluent|\Satupersen\Database\Schema\ForeignKeyDefinition
     */
    public function constrained()
    {
        return $this->references('id')->on(Str::plural(Str::before($this->name, '_id')));
    }

    /**
     * Specify which column this foreign ID references on another table.
     *
     * @return \Satupersen\Support\Fluent|\Satupersen\Database\Schema\ForeignKeyDefinition
     */
    public function references($column)
    {
        return $this->blueprint->foreign($this->name)->references($column);
    }
}
