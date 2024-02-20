<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Location extends Model
{
    use HasFactory;

    protected $fillable = ['participant_id', 'latitude', 'longitude', 'address', 'city', 'country'];

    public function participant(): BelongsTo
    {
        return $this->belongsTo(Participant::class);
    }
}
