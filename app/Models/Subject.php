<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $fillable =['id','name','teacher'];
    
    public function student(){
        return $this->hasMany(Students::class);
    }
}
