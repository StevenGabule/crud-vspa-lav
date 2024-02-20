<?php

namespace App\Services;

use App\Models\Location;
use Illuminate\Support\Facades\DB;
use Exception;
use Throwable;

class LocationService extends BaseService {
    public function __construct(Location $location)
    {
        $this->model = $location;
    }

    /**
     * @throws Throwable
     */
    public function store(array $data = []): Location
    {
        DB::beginTransaction();

        try {
            $location = $this->model->create($data);
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
        DB::commit();

        return $location;
    }

    /**
     * @throws Throwable
     */
    public function update(Location $location, array $data): Location
    {
        DB::beginTransaction();
        try {
            $location->update($data);
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
        DB::commit();

        return $location;
    }


    public function delete(Location $location): Location
    {
        $location->delete();
        return $location;
    }

}
