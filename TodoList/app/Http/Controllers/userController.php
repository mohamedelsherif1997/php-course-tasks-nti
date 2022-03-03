<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\users;


class userController extends Controller
{
    //

    public function index(){
        // code .....



       $data =  users :: orderBy('id','desc')->get();

       //->take(2)

        return view('students.index',["data" => $data]);
    
    }




   public function create(){
       return view('Users.create');
      }


      public function Store(Request $request){
          // code .....

      $data =  $this->validate($request,[
              "name"     => "required|min:3",
              "email"    => "required|email",
              "password" => "required|min:6"
       ]);

      //  student::create(["name" => $request->name , "email" => $request->email , "password" => $request->password]);

      $data['password'] = bcrypt($data['password']);

      $op = users :: create($data);

       if($op){
           $message = 'data inserted';
       }else{
           $message =  'error try again';
       }

       session()->flash('Message',$message);

       return redirect(url('/User/'));



      }



 public function edit($id){

   // code
   // $data = student :: where('id',$id)->get();
   $data = users :: find($id);

      return view('Users.edit',["data" => $data]);
 }


 public function update(Request $request,$id){


   $data =  $this->validate($request,[
       "name"     => "required|min:3",
       "email"    => "required|email"
     ]);

    $op =  users :: where('id',$id)->update($data);

    if($op){
       $message = 'Raw Updated';
   }else{
       $message =  'error try again';
   }

   session()->flash('Message',$message);

   return redirect(url('/User/'));



 }





   public function delete($id){
      // code .....

   //  $op =  student::where('id',$id)->delete();     // find($id)
     $op =  users::find($id)->delete();
     if($op){
        $message = "Raw Removed";
     }else{
        $message = 'Error Try Again';
     }

      session()->flash('Message',$message);

      return redirect(url('/User/'));

      }




      public function login(){
          return view('Users.login');
      }


      public function doLogin(Request $request){

       $data =  $this->validate($request,[
           "password"  => "required|min:6",
           "email"     => "required|email"
         ]);


         if(auth()->attempt($data)){

          return redirect(url('/User'));

         }else{
             session()->flash('Message','invalid Data');
             return redirect(url('/User/Login'));
         }


      }




      public function LogOut(){
          // code .....

          auth()->logout();
          return redirect(url('/User/Login'));
      }


}

