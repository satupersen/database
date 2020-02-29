<?php

namespace Satupersen\Database\Eloquent;

interface Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Satupersen\Database\Eloquent\Builder  $builder
     * @param  \Satupersen\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model);
}
