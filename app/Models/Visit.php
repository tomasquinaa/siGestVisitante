<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'document_number',
        'contact',
        'related_person',
        'department_id',
        'visit_type',
        'pass_given',
        'entry_time',
        'exit_time',
        'department_id',
        'company_id',
    ];

    public function department()
    {
       return $this->belongsTo(Department::class);
    }

    public function company()
    {
        return $this->belongsTo(Companies::class);
    }
}
