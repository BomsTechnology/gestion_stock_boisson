<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Output extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $fillable = [
        'id',
        'amount',
        'user_id',
        'customer_id',
    ];

    protected $casts = [
        
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function drinks()
    {
        return $this->morphToMany(Drink::class, 'move')->withPivot('quantity', 'price')->withTimestamps();;
    }
}
