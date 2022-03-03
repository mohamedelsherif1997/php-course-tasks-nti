<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\tasks;


class listController extends Controller
{
    //

    public function index()
    {
        //

        $data = tasks::join('users', 'users.id', '=', 'tasks.user_id')->select('tasks.*', 'users.name as userName')->get();

        return view('Tasks.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data =   $this->validate($request, [
            "tasks"   => "required|max:100",
            "content" => "required|max:5000",
            "sDate"   => "required|date",
            "eDate"   => "required|date",
            "image"   => "required|image|mimes:png,jpg"    

        ]);

        $FinalName = time() . rand() . '.' . $request->image->extension();

        if ($request->image->move(public_path('blogImages'), $FinalName)) {


            $data['image'] = $FinalName;
            $data['user_id'] = auth()->user()->id;

            $op = tasks::create($data);

            if ($op) {
                $message = 'data inserted';
            } else {
                $message =  'error try again';
            }
        } else {
            $message = "Error In Uploading File ,  Try Again ";
        }

        session()->flash('Message', $message);

        return redirect(url('/Task'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        $data = tasks::find($id);

        return view('Tasks.edit', ['data' => $data]);
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
        //

        $data =   $this->validate($request, [
            "title"   => "required|max:100",
            "content" => "required|max:5000",
            "sDate"   => "required|date",
            "eDate"   => "required|date",
            "image"   => "nullable|image|mimes:png,jpg"    

        ]);

        #   Fetch Data
        $objData = tasks::find($id);


        if ($request->hasFile('image')) {

            $FinalName = time() . rand() . '.' . $request->image->extension();

            if ($request->image->move(public_path('tasksImages'), $FinalName)) {

                unlink(public_path('tasksImages/' . $objData->image));
            }
        } else {
            $FinalName = $objData->image;
        }


        $data['image'] = $FinalName;

        # Update OP ...

        $op = tasks::find($id)->update($data);



        if ($op) {
            $message = 'Raw Updated';
        } else {
            $message =  'error try again';
        }

        session()->flash('Message', $message);

        return redirect(url('/Task'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        # Fetch Data
        $data =  tasks::find($id);

        $op =  tasks::find($id)->delete();
        if ($op) {
            unlink(public_path('tasksImages/' . $data->image));
            $message = "Raw Removed";
        } else {
            $message = "Error Try Again";
        }

        session()->flash('Message', $message);

        return redirect(url('/Task'));
    }
}
