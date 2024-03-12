<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;


    // table relations
    public function job(){
        return $this->belongsTo(Job::class);
    }

    // User table relation
    public function user(){
        return $this->belongsTo(User::class);
    }

    // User table relation
    public function employer(){
        return $this->belongsTo(User::class,'employer_id');
    }

}
