<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class userController extends Controller
{
    public function create(){
        return view('create');
       }
   
       public function store(Request $request){
      
         $this->validate($request,[
             "title"  => "required",
             "content" => "required|email",$request->validate([
             'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
            ])
         ]);
   
   
   
         echo 'Valid Data';
       }
   
   
   
   
   
   public function index(){
   
    return view('profile',compact('title', 'content' , 'image'));

   
   }
   
   
   
   
   }