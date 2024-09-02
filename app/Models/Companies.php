<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'contact',
        'logo_path'
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'company_id');
    }

    public function departments()
    {
        return $this->hasMany(Department::class);
    }

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }

}
