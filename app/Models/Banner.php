<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'page_id', 'subtitle', 'image', 'button_text', 'button_link', 'status', 'alt_text'];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
