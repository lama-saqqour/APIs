<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class _oldPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'from',
        'to',
        'sonata_price',
        'gms_price',
        'h1_price',
        'ford_price',
        'lexus_price',
        'mercedes_price',
    ];

    protected $table = 'prices';
}
