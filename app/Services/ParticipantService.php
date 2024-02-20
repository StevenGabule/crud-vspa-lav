<?php

namespace App\Services;

use App\Models\Location;
use App\Models\Participant;
use Illuminate\Support\Facades\DB;
use Exception;
use Throwable;

class ParticipantService extends BaseService {
    public function __construct(Participant $participant)
    {
        $this->model = $participant;
    }

    /**
     * @throws Throwable
     */
    public function store(array $data = []): Participant
    {
        DB::beginTransaction();

        try {
            $participant = $this->model->create($data);
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
        DB::commit();

        return $participant;
    }

    /**
     * @throws Throwable
     */
    public function update(Participant $participant, array $data): Participant
    {
        DB::beginTransaction();
        try {
            $participant->update($data);
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
        DB::commit();

        return $participant;
    }


    public function delete(Participant $participant): Participant
    {
        $participant->delete();
        return $participant;
    }

}
