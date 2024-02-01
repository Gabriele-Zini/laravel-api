<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Technology extends Model
{
    use HasFactory;

    // fillable

    protected $fillable=['technology_name', 'slug', 'hex_color'];

     /* accessor */

     public function getTechnologyNameAttribute($value) {
        return ucfirst($value);
     }

    //  mutator
    public function setTechnologyNameAttribute($value)
    {
        $this->attributes['technology_name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

     public function projects() {
        return $this->belongsToMany(Project::class);
     }

}
