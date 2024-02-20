<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

class BaseResource extends JsonResource
{
    protected Collection $include;

    public function __construct($resource)
    {
        $this->include = collect(explode(',', request()->get('include')))->filter();

        if (!is_array($resource)) {
            foreach ($this->include as $relation) {
                if ($resource && $resource->isRelation($relation)) {
                    $resource->loadMissing($relation);
                }
            }
        }

        parent::__construct($resource);
    }
}
