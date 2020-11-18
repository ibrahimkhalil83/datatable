<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Student;
use Yajra\DataTables\DataTables;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('student.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required',
            'roll'        => 'required',
            'mobile_number'  => 'required|numeric',
        ]);

        $student=DB::table('students')->insert(['name'=>$request->name,'phone'=>$request->mobile_number,'roll'=>$request->roll]);
        return Student::all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return DB::table('students')->where('id',$id)->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student=DB::table('students')->where('id',$id)->first();
        return Response()->json($student);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'edit_name'           => 'required',
            'edit_roll'        => 'required',
            'edit_mobile_number'  => 'required|numeric',
        ]);

        DB::table('students')->where('id',$id)->update(['name'=>$request->edit_name,'phone'=>$request->edit_mobile_number,'roll'=>$request->edit_roll]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       DB::table('students')->where('id',$id)->delete();
    }

    public function allStudents(){
        $student=Student::all();
        return Datatables::of($student)
               ->addColumn('action', function($student){
                    return '<a class="btn btn-success" >View</a>'.' '.'<a class="btn btn-info" onclick="editData('.$student->id.')">Edit</a>'.' '.'<a onclick="deleteData('.$student->id.')" class="btn btn-danger" >Delete</a>';
               })->addColumn('status',function($student){
                   return `
                        @if($student->status==1)
                            active
                        @else
                        inactive
                   `;
               })
               ->make(true);
    }
}
