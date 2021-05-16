<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    public function laboratory()
    {
        return $this->belongsTo(Laboratory::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function form_statuses()
    {
        return $this->hasMany(FormStatus::class);
    }

    public function practicians()
    {
        return $this->hasMany(Practician::class);
    }

    public function tools()
    {
        return $this->hasMany(Tool::class);
    }

    public function materials()
    {
        return $this->hasMany(Material::class);
    }
}
