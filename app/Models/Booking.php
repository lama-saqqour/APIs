<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Booking extends Model
{
    use HasFactory, Notifiable, SoftDeletes;
    
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
    
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'date',
        'time',
        'return_date',
        'return_time',
        'booking_status',
        'booking_type',
        'is_return',
        'is_paid',
        'is_deleted',
        'notes',
        'user_id',
        'trip_price_id',
        'site_price_id',
        
    ];
    
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];
    
    protected $table = 'bookings';
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function trip_price()
    {
        return $this->belongsTo(TripPrice::class);
    }
    
    public function site_price()
    {
        return $this->belongsTo(SightseeingPrice::class);
    }
    
    public function additional_info()
    {
        return $this->hasMany(AdditionalInfo::class,'bookings_id');
    }
    
    public function payments()
    {
        return $this->hasMany(Payment::class,'bookings_id');
    }
    public function services()
    {
        return $this->morphToMany(Services::class,'serviceable');
    }
}
