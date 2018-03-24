<?php

namespace App\Http\Controllers\cpanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB; 
use Auth;
use Validator;
use App\User;
use App\Role;

class AccountsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'logout']);
    }

    public function index() {
    	$users = DB::table('users')
    	->select('users.*', 'roles.name as role_name')
    	->join('role_user', 'users.id', '=', 'role_user.user_id')
    	->join('roles', 'role_user.role_id', '=', 'roles.id')
    	->get();

        $role_user_id = Auth::user()->id;

        $role_restriction = DB::table('role_user')
            ->select("role_id as position")
            ->where("user_id", $role_user_id)
            ->first();

    	return view('cpanel.accounts', compact('users', 'role_restriction'));
    }

    public function account_add_form() {
    	$roles = Role::all();

    	return view('cpanel.partials.add_account_modal', ['roles'=>$roles]);
    }


    public function accounts_add_save(Request $request) {
    	$user = new User;

    	$validator = Validator::make($request->all(),
            [
            'name'=>'required',
            'contact'=>'nullable',
            'email'=>'required|string|email|max:255|unique:users',
            'password'=>'required|string|min:6',
            'role_id'=>'required'

            ]
        );

        if ($validator->fails()){
            return response()->json(['code' => 0, 'messages' => $validator->getMessageBag()]);
        } 
        else {
        	if($request->password != $request->password_confirm) {
        		return response()->json(['code' => 0, 'messages' => array("password_confirm" => "Password didn't match")]);	
        	} else {
        		$user->name = $request->name;
	            $user->contact = $request->contact;
	            $user->email = $request->email;
	            $user->password = bcrypt($request->password);
	            $user->save();

	            $dataset = [];
	            $dataset[] = [
                    'role_id'=>$request->role_id,
                    'user_id'=>$user->id
                ];

                DB::table('role_user')->insert($dataset);
        	}
        }

    }

    public function accounts_update_save(Request $request) {
        $accounts = User::find($request->id);
        $accounts->name = $request->name;
        $accounts->contact = $request->contact;
        $accounts->email = $request->email;

        if($accounts->email == $request->email) {
            $validator = Validator::make($request->all(),
                [
                'name'=>'required',
                'contact'=>'nullable',
                'email'=>'required|string|email|max:255',
                'role_id'=>'required'

                ]
            );
        } else {
            $validator = Validator::make($request->all(),
                [
                'name'=>'required',
                'contact'=>'nullable',
                'email'=>'required|string|email|max:255|unique:users',
                'role_id'=>'required'

                ]
            );  
        }

        

        if ($validator->fails()){
            return response()->json(['code' => 0, 'messages' => $validator->getMessageBag()]);
        } else {
            $accounts->save();
            DB::table('role_user')->where("user_id", "=", $request->id)->update(['role_id' => $request->role_id]);

            return response()->json(['code' => 1, 'messages' => 'User Account Successfully Updated']);

        }
    }

    public function accounts_cpassword_save(Request $request) {
        $accounts = User::find($request->cpassword_id);

        $validator = Validator::make($request->all(),
            [
            'password'=>'required|string|min:6',
            'password_confirm'=>'required'

            ]
        );

         if ($validator->fails()){
            return response()->json(['code' => 0, 'messages' => $validator->getMessageBag()]);
        } else {
            if($request->password != $request->password_confirm) {
                return response()->json(['code' => 0, 'messages' => array("password_confirm" => "Password didn't match")]); 
            } else {
                $accounts->password = bcrypt($request->password);
                $accounts->save();
                return response()->json(['code' => 1, 'messages' => 'Password Successfully Updated']);
            }
        }
    }


    public function account_data_fetch(Request $request) {
        $id = $request->id;
        $role_user_id = Auth::user()->id;
        $account = User::find($id);

        $roles = Role::all();

        $role_user = DB::table('role_user')
            ->select('role_user.*', 'roles.name as role_name')
            ->join("roles", "role_user.role_id", "=", "roles.id")
            ->where("role_user.user_id", "=", $id)
            ->get();

        $role_restriction = DB::table('role_user')
            ->select("role_id as position")
            ->where("user_id", $role_user_id)
            ->first();


        return view("cpanel.partials.update_account_modal", compact("account", "roles", "role_user", "role_restriction"));

    }


    public function account_delete(Request $request) {
        $id = $request->id;
        $account = User::find($id);
        $account->delete();

        DB::table('role_user')
        ->where("user_id", $id)
        ->delete(); 
  
    }

}
