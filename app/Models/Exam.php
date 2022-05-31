<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
    protected $fillable =['id','teacher','student','valutation'];
    public function teach(){
        return $this->hasOne(Teachers::class,'id');
    }
    public function studente(){
        return $this->hasOne(Students::class, 'id');
    }
}
