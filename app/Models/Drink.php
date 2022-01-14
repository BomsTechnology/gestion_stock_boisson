<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drink extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $fillable = [
        'id',
        'name',
        'price',
        'quantity'
    ];

    protected $casts = [
        
    ];

    public function inputs()
    {
        return $this->morphedByMany(Input::class, 'move');
    }

    public function outputts()
    {
        return $this->morphedByMany(Output::class, 'move');
    }
}
