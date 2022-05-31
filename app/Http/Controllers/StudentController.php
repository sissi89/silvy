<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Exam;

class StudentController extends Controller
{
    public function getStudents(){
        return  Student::all();
      } 
      // get by id
      public function getStudentById($id){
        if(Student::where('id',$id)->exists()){
          $student = Student::find($id);
          return response()->json($student);
      }else{
        return responce()->json([ "message" => "student not found"],404);
      }
      }
      // post
      public function postStudents( Request $req){
        $req->validate([
          'serialname'=>'required',
          'name'=>'required'
        ]); 
        $student = new Student; //$request->input('name');
        $student->serialname = $req->input('serialname');
        $student->name = $req->input('name');
        $student->save();
        return response()->json([
          "message" => "Student Added."
      ], 201); 
      }
      // put
      public function putStudents(Request $req, $id){
        if(Student::where('id',$id)->exists()){
          $student = Student::find($id);
          $req->validate([
            'serialname'=>'required',
            'name'=>'required'
          ]);
          $student->serialname = $req->input('serialname');
          $student->name = $req->input('name');
          $student->save();
          return response()->json([
            "message" => " Student Updated"
        ], 404);
    }else{
        return response()->json([
            "message" => "Student  Not Found"
        ], 404); 
    
        }
    
      }
    // delete 
    public function deleteStudent($id){
      if(Students::where('id', $id)->exists()) {
        $student = Student::find($id);
        $student->delete();
    
        return response()->json([
          "message" => "records deleted."
        ], 202);
    } else {
        return response()->json([
          "message" => "student not found."
        ], 404);
    }
    }
    
      // crud api Exams 
      public function getExams(){
        return Exam::all();
      }
      // crud api Subjects
      public function getSubjects(){
        return Subject::all();
      }
      // crud apo Teachers
      public function getTeachers(){
          return  Teacher::all();
      }
      // Recupera le materie che insegna un professore.
      public function getSubjectsOfProf($teach){
          
        if (Subject::where('teacher',$teach)->exists()){
            
            return response()->json(Subjects::where('teacher',$teach)->get());
        }else{
            return response()->json([ "message" => "Teach not found"],400);
        } 
        /* try{
            
              return response()->json(Subjects::where('teacher',$teach)->get());
            
            
        }catch(Throwable $e){
            report($e);
            return response()->json(["messsage"=>$e]);
        } */
      }
      // recuperare gli studenti che sono stati bocciati da una materia 
      public function getSubjectsOfFall(  $subject){ ///examsFalls/{subject}' ok
        //                    table primay                esterna di exam 
        if(Subject::where('id_subject',$subject)->exists()){
          return response()->json(Exams::with('studente')->where('valutation','<','18')->where('subject','=',$subject)->get());
        }else{
          return response()->json([ "message" => "Subject not found"],400);
        }  
        // ok
      /*   try{
          
        $student = Exams::with('studente')->where('valutation','<','18')->where('subject','=',$subject)->get();
        return response()->json($student);
        }catch(ModelNotFoundException $e){
          // ((Subjects::where('id_subject',$subject)->exists()))
        // (Subjects::where('id_subject',$subject)->exists())
        
            return  response()->json([ "message" => "Subject not found"],400);
    
        } */
    
      }
      // Recupera la media del voto degli esami di una materia
      public function getAvgSubject($subject){
        
          //return Exams::join('subjects','subject','=','subject')->where('subject','=',$subject)->avg('valutation');
          return Exam::with('subjects')->where('subject','=',$subject)->avg('valutation');
      }
      //  Recupera la media di uno studente 
      public function getAvgStudents($student){ // avgStudents
        // return Exams::join('students','serialName','=','student')->where('student','=',$student)->avg('valutation');
          return Exam::with('students')->where('student','=',$student)->avg('valutation');
      }
      // Partendo dagli esami, recupera le informazioni del professore che ha bocciato più persone
      public function getProfPlusSeveres(){ // teachersSeveres
          // exam teacher info fall peoples non function
          
        
        return response()->json(Exam::with(['teach'])->where('valutation','=',17)->groupBy('id')->get());
    
      }
      // Recupera gli studenti che hanno effettuato l’esame di una materia almeno 3 volte nell’ultimo anno
      public function getStudentHelp(){
        //$full = $full->sortBy('count')->take(5); 
        return response()->json(Exam::with('studente')->orderBy('student','ASC')->take(3)->get());
        
      }
      //  Recupera gli esami superati da uno studente e ordinali per voto.
      public  function getExamsStudent($student){
      // da exams ordinare per voto
    
      return responce()->json(Exam::with('studente')->where('student','=',$student)->orderBy('valutation','ASC')->get());
    }
    // Recupera lo studente che ha la media più alta
    public function getStudentNerd(){
      // unisco tabelle esami con studente ordino per studente calcolo la media limit 1
        return Exams::with('studente')->selectRaw('avg(valutation) as vote_avg,student')->
        groupBy('student')->orderBy('valutation','DESC')->get();
        /*  ->selectRaw('avg(vote) as voto_medio,student_id')
        ->groupBy('student_id')
        ->orderBy('vote', 'DESC')
        ->get();
        return response()->json($query,200); */
    }
}
