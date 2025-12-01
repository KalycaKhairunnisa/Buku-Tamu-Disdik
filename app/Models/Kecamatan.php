<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kecamatan extends Model
{
    protected $table = 'kecamatan';

    protected $fillable = [
        'nama',
        'keterangan',
    ];

    public function guestBooks(): HasMany
    {
        return $this->hasMany(GuestBook::class);
    }
}
