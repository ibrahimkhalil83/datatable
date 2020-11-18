<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use DB;

use Yajra\DataTables\DataTables;
class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post=DB::table('contacts')->get();
        // return Response()->json($post);
        return view('post');
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
        $data=array();
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['phone']=$request->phone;
        DB::table('contacts')->insert($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        return $contact;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        return $contact;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        $id=$contact->id;
        $data=array();
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['phone']=$request->phone;
        DB::table('contacts')->where('id',$id)->update($data);
        // return $data;
        // return $contact;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        DB::table('contacts')->where('id',$contact->id)->delete();
    }

    public function allContact(){
        $contact=Contact::all();
        return Datatables::of($contact)
               ->addColumn('action', function($contact){
            return '<a onclick="showData('.$contact->id.')" class="btn btn-sm btn-success">Show</a>'.' '.
                    '<a onclick="editForm('.$contact->id.')" class="btn btn-sm btn-info">Edit</a>'.' '.
                    '<a onclick="deleteData('.$contact->id.')" class="btn btn-sm btn-danger">Delete</a>';
               })->make(true);
    }
    public function allBlog(){
        $blog=Blog::all();
        return Datatables::of($blog)
               ->addColumn('action', function($blog){
            return '<a onclick="showData('.$blog->id.')" class="btn btn-sm btn-success">Show</a>'.' '.
                    '<a onclick="editForm('.$blog->id.')" class="btn btn-sm btn-info">Edit</a>'.' '.
                    '<a onclick="deleteData('.$blog->id.')" class="btn btn-sm btn-danger">Delete</a>';
               })->make(true);
    }

}
