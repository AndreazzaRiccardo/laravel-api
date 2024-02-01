<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Type extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function getNameAttribute($value) {
        return ucFirst($value);
    }

    public function setNameAttribute($_name) {
        $this->attributes['name'] = $_name;
        $this->attributes['slug'] = Str::slug($_name, '&');
    }

    public function projects() {
        return $this->hasMany(Project::class);
    }
}
