<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CabBookingPackage extends Model
{
    protected $fillable = [
        'cab_name',
        'vehicle_type',
        'images',
        'seating_capacity',
        'price',
        'description',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'images'           => 'array',
            'status'           => 'boolean',
            'seating_capacity' => 'integer',
            'price'            => 'decimal:2',
        ];
    }

    public function packages()
    {
        return $this->hasMany(Package::class);
    }

    public function enquiries()
    {
        return $this->hasMany(Enquiry::class);
    }
}
