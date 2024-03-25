<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sightseeing extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'category_id',
    ];

    
    protected $table = 'sightseeings';

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function prices()
    {
        return $this->hasMany(SightseeingPrice::class);
    }
}
