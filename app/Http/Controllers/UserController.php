<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignupRequest;
use App\Models\Route as ModelsRoute;
use App\Models\User;
use App\Models\UserRoute;
use App\Models\UserSubRoute;
use Illuminate\Http\Request;
use Route;

class UserController extends Controller
{

    public function create(){

        $users = User::all();

        return view('auth.users',compact('users'));

    }

    public function store(SignupRequest $request){

        $user =  new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->user_type = $request->user_type;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect('users')->with('message','تم حفظ بيانات المستخدم');
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


    public function editRoutes(Request $request){

       $add =  $request->get('add');
       $user_id =  $request->get('user_id');
       $route_id =  $request->get('route_id');
       $userRoute =   UserRoute::where('user_id',$user_id)->where('route_id',$route_id);
       if (!$add){
           $userRoute->delete();

       }else{
           UserRoute::create(['user_id'=>$user_id,'route_id'=>$route_id]);

       }
       return ['status'=>true,'user'=>User::find($user_id)];
    }
    public function editSubRoutesRoutes(Request $request){

        $add =  $request->get('add');
        $user_id =  $request->get('user_id');
        $route_id =  $request->get('sub_route_id');
        $userRoute =   UserSubRoute::where('user_id',$user_id)->where('sub_route_id',$route_id);
        if (!$add){
            $userRoute->delete();

        }else{
            UserSubRoute::create(['user_id'=>$user_id,'sub_route_id'=>$route_id]);

        }
        return ['status'=>true,'user'=>User::find($user_id)];
    }
    public function routes(){
        return ModelsRoute::all();
    }
  
    public function all()
    {
        return User::with('roles')->get();
    }
 

    
}


