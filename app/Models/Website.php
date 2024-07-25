<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    use HasFactory;

    public const DEFAULT_RESULTS_PER_PAGE = 30;

    protected $fillable = [
        'url',
        'description',
        // 'submitted_by', // If we ever wanted to track this
    ];

    /**
     * Get the votes for this website
     */
    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'website_categories');
    }

    public function getRankAttribute()
    {
        // Logic to calculate the website's rank based on votes
    }
}
