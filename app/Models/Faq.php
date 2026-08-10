<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'answer',
        'order',
        'status',
        'package_id',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
