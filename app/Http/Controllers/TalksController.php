<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Talk;

class TalksController extends Controller
{
    //
    public function show()
    {
        return view('talk');
    }


    public function add(Request $request)
    {
        //validate
        validator([
            'title' => 'required',
            'talk_detail' => 'required',
            'speaker'  => 'required'
        ]); //validates request 

        $talk = new Talk();
        $talk->title = $request->title;
        $talk->talks_detail = $request->talk_detail;
        $talk->speaker = $request->speaker;
        $created_talk = $talk->save();

        if ($created_talk) {
            return "<script>alert('Talk created'); window.location.replace('/talk/add')</script>";
            
            //return response($content =['message' => 'Talk created successfully', 'data' => [], 'response'=> 'created'], 201);
        }else{
            return "<script>alert('oops! Talk cannot be created'); window.location.replace('/talk/add')</script>";
            //return response($content =['message' => 'Talk not created', 'data' => $php_errormsg, 'response'=> 'error'], 400);
        }
    }

    public function delete($id) 
    {
        $delete = Talk::destroy($id);
        if ($delete){
            return response($content =['message' => 'Talk deleted successfully', 'data' => [], 'response'=> 'error'], 200);
        }else{
            return response($content =['message' => 'Bad request', 'data' => $php_errormsg, 'response'=> 'error'], 404);
        }
    }

}
