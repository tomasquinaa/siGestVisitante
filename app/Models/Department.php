<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = ['name','company_id'];

    public function users()
    {
        return $this->hasMany(User::class, 'departament_id');
    }

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }

    public function company()
    {
        return $this->belongsTo(Companies::class);
    }
}
