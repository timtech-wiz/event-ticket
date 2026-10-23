<?php

namespace App\Models;

use App\Collections\EventCollection;
use App\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes, HasSlug;


    protected $guarded = [];


    protected $attributes = [
        'status' => 'draft'
    ];

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }

    public function oldestEvent():HasOne
    {
        return $this->hasOne(Ticket::class)->latestOfMany();
    }

    public function newCollection(array $models = []): EventCollection
    {
        return new EventCollection($models);
    }
}
