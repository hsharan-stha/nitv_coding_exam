<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $table = 'profiles';

    protected $fillable = [
        'name', 'image', 'gender', 'phone',
        'email', 'nationality',
        'date_of_birth',
        'mode_of_contact',
    ];

    public function qualification_create()
    {
        return $this->belongsTo(EducationQualification::class);
    }

    public function qualification_index()
    {
        return $this->hasMany(EducationQualification::class);
    }
}
