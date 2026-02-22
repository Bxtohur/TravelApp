<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'image', 'price', 'facilities', 'destinations'
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
