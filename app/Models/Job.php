<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    public function jobType(){
        return $this->belongsTo(JobType::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    // hasMany method count your total applications
    public function applications(){
        return $this->hasMany(JobApplication::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
