<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_id',
        'name',
        'information',
        'filename',
        'is_selling'
    ];

    public function Owner()
    {
        return $this->belongsTo(Owner::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
