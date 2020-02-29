<?php

namespace Satupersen\Database\Eloquent;

use Satupersen\Contracts\Queue\EntityNotFoundException;
use Satupersen\Contracts\Queue\EntityResolver as EntityResolverContract;

class QueueEntityResolver implements EntityResolverContract
{
    /**
     * Resolve the entity for the given ID.
     *
     * @param  string  $type
     * @param  mixed  $id
     * @return mixed
     *
     * @throws \Satupersen\Contracts\Queue\EntityNotFoundException
     */
    public function resolve($type, $id)
    {
        $instance = (new $type)->find($id);

        if ($instance) {
            return $instance;
        }

        throw new EntityNotFoundException($type, $id);
    }
}
