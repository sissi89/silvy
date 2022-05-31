<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $fillable =['id','name','subject'];
    /*   function  */
    public function student(){
      return $this->belongsToMany(Students::class,'teachers');
  }
  public function exam(){
    return $this->hasOne(Exams::class,'exams');
  }
}
