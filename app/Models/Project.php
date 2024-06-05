<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Project extends Model
{
    use HasFactory;

    public function type() {
        return $this->belongsTo(Type::class);
    }

    public function technologies() {
        return $this->belongsToMany(Technology::class);
    }

    protected $fillable = [
        'title',
        'slug',
        'link',
        'image',
        'original_image',
        // 'type',
        'type_id',
        'description'
    ];
}
