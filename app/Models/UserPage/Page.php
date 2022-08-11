<?php

namespace App\Models\UserPage;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'username', 'meta'
    ];

    protected $casts = [
        'meta' => 'array'
    ];

    public function fields() {
        return $this->hasMany(Field::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
