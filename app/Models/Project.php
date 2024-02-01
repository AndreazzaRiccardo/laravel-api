<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Notifications\Notifiable;

class Project extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = ['name', 'description', 'link', 'slug', 'type_id'];

    public function getCreatedatAttribute($value)
    {
        return date('d-m-Y', strtotime($value));
    }

    public function getNameAttribute($value)
    {
        return ucFirst($value);
    }

    public function setNameAttribute($_name)
    {
        $this->attributes['name'] = $_name;
        $this->attributes['slug'] = Str::slug($_name, '&');
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function technologies()
    {
        return $this->belongsToMany(Technology::class);
    }
}
