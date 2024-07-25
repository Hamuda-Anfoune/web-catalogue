<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'created_by', // If we wanted to track creators
    ];

    public function websites()
    {
        return $this->hasMany(Website::class);
    }
}
