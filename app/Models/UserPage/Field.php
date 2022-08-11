<?php

namespace App\Models\UserPage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', 'order', 'enabled', 'meta'
    ];

    protected $casts = [
        'order' => 'integer',
        'enabled' => 'boolean',
        'meta' => 'array',
    ];

    public function page() {
        return $this->belongsTo(Page::class);
    }
}
