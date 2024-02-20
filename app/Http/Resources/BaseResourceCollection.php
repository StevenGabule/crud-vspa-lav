<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Auth;

class BaseResourceCollection extends ResourceCollection
{
    public function paginationInformation($request, $paginated, $default): array
    {
        unset($default['links']);
        unset($default['meta']);

        $default['meta']['current_page'] = $paginated['current_page'];
        $default['meta']['pages_total'] = $paginated['last_page'];
        $default['meta']['per_page'] = $paginated['per_page'];
        $default['meta']['results_total'] = $paginated['total'];

        return $default;
    }

    public function toResponse($request)
    {
        $response = parent::toResponse($request);
        $data = $response->getData();

        if (property_exists($data, 'meta')) {
            return $response->setData([
                'data' => $data
            ]);
        }

        return $response;
    }
}
