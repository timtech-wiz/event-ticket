<?php

namespace App\Models;

use App\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use HasFactory, SoftDeletes, HasSlug;

    protected $fillable = [
        'event_id',
        'name',
        'price',
        'quantity',
        'quantity_sold',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'quantity' => 'integer',
        'quantity_sold' => 'integer',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}