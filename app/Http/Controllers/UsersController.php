<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        return view('project.users.index');
    }

    public function users_table_ajax(Request $request)
    {
        $data = User::get();
        return response()->json([
            'success' => true,
            'view' => view('project.users.ajax.users_table_ajax',['data'=>$data])->render()
        ]);
    }

    public function create(Request $request)
    {
        $data = new User();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->user_role = $request->user_role;
        $data->user_status = $request->user_status;
        if ($data->save()){
            return redirect()->back();
        }
    }

    public function update(Request $request){
        $data = User::where('id',$request->user_id)->first();
        $data->name = $request->name;
        $data->email = $request->email;
        if ($request->filled('password')){
            $data->password = $request->password;
        }
        $data->user_role = $request->user_role;
        if ($data->save()){
            return redirect()->back();
        }
    }

    public function update_status(Request $request){
        $data = User::where('id',$request->user_id)->first();
        if ($request->value == 'true'){
            $data->user_status = 'active';
        }
        else{
            $data->user_status = 'not_active';
        }
        if ($data->save()){
            return response()->json([
                'success' => true,
                'message' => 'تم تعديل حالة المستخدم'
            ]);
        }
    }
}
