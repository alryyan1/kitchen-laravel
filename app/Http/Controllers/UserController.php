<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignupRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function create(){

        $users = User::all();

        return view('auth.users',compact('users'));

    }

    public function store(SignupRequest $request){

        $validated = $request->validated();

        $user =  new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->user_type = $request->user_type;
        $user->password = bcrypt($request->password);
        $user->save();


        return redirect('users',compact('validated'))->with('message','تم حفظ بيانات المستخدم');
    }

    public function update(Request $request){

        $user =   User::find($request->user_id);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->user_type = $request->user_type;
        // if($request->password){$user->password = bcrypt($request->password);}
        $user->update();

        return redirect('users')->with('message','تم تعديل بيانات المستخدم');;
    }

    public function destroy($user_id)
    {
        User::where('id',$user_id)->delete();
        return redirect('users')->with('message','تم حذف بيانات المستخدم');;

    }
}
