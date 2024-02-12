<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
  public function index(){
    $students= Student::all();
    return response()->json([
        'status' => 200,
        'students' => $students,
        ],200);
  }
  public function store(Request $request){
    $validator=Validator::make($request->all(),[
        'name'=>'required|max:191',
        'course'=>'required|string|max:190',
        'email'=>'required|email|max:190',
        'phone'=>'required|digits:10',
    ]);

    if($validator->fails()){
        return response()->json([
            'status'=>422,
            'errors'=>$validator->messages(),
        ],422);
    }
     Student::create([
      'name'=>$request->name,
      'course'=>$request->course,
      'email'=>$request->email,
      'phone'=>$request->phone
     ]);
     return response()->json([
        'status'=>200,
        'msg'=>'new student created successfully'
     ],200);
  }

  public function show($id){
   $student=Student::find($id);
   if($student){
    return response()->json([
        'status'=>200,
        'student'=>$student,
    ],200);
   }else{
    return response()->json([
        'status'=>404,
        'errors'=>'data not found',
    ],404);
   }
  }

public function edit($id){
    $student=Student::find($id);
    if($student){
     return response()->json([
         'status'=>200,
         'student'=>$student,
     ],200);
    }else{
     return response()->json([
         'status'=>404,
         'errors'=>'data not found',
     ],404);
    }
}
public function update( $id , Request $request){
  $validator=Validator::make($request->all(),[
        'name'=>'required|max:191',
        'course'=>'required|string|max:190',
        'email'=>'required|email|max:190',
        'phone'=>'required|digits:10',
    ]);
    if($validator->fails()){
        return response()->json([
            'status'=>422,
            'error'=>$validator->messages(),
        ],422);
    }
    $student=Student::find($id);
     $student->create([
      'name'=>$request->name,
      'course'=>$request->course,
      'email'=>$request->email,
      'phone'=>$request->phone
     ]);
     return response()->json([
        'status'=>200,
        'msg'=>'student uodated successfully'
     ],200);
 }

 public function destroy($id)
 {
     Student::findOrFail($id)->delete();
     return response()->json([
        'data'=>'student data deleted successfully'
     ]);
 }

}
