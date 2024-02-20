<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Participant extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone_number', 'bio'];

    public function locations(): HasMany
    {
        return $this->hasMany(Location::class);
    }
}
