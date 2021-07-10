<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationQualification extends Model
{
    use HasFactory;

    protected $table = 'educational_qualification';

    protected $fillable = [
        'school_name', 'from_year', 'to_year', 'result', 'profile_id'
    ];


}
