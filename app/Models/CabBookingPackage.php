<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CabBookingPackage extends Model
{
    protected $fillable = [
        'cab_name',
        'slug',
        'vehicle_type',
        'images',
        'seating_capacity',
        'price',
        'description',
        'status',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'meta_tags',
        'alt_text',
    ];

    protected function casts(): array
    {
        return [
            'images'           => 'array',
            'status'           => 'boolean',
            'seating_capacity' => 'integer',
            'price'            => 'decimal:2',
            'alt_text'         => 'array',
        ];
    }

    public static function generateSlug($cabName)
    {
        $slug = Str::slug($cabName);
        $count = self::where('slug', 'LIKE', "{$slug}%")->count();

        return $count ? "{$slug}-{$count}" : $slug;
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
