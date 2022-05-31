<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $table = 'students';
    protected $fillable =['id','serialname','name'];
    
    public function teacher(){
        return $this->belongsToMany(Teachers::class,'teachers');
    }
}
