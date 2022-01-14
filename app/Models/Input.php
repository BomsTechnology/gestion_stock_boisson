<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Input extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $fillable = [
        'id',
        'amount',
        'user_id',
        'provider_id',
    ];

    protected $casts = [
        
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function drinks()
    {
        return $this->morphToMany(Drink::class, 'move');
    }
}
