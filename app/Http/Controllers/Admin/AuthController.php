<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    use ResponseTrait;
    public function login(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [

                'email' => 'required|exists:users,email',
                'password' => 'required',
            ],
            $messages = [
                'email.exists' => __('phone not associated with any account'),
            ]
        );


        if ($validator->fails()) {
            return $this->error_message('request parameters wrong');
        }
        try {

            $user = User::where('status',1)->where('email', $request->email)->first();
            $hash = Hash::check($request->password, $user->password);

            $data = ['id' => $user->id, 'name' => $user->name, 'phone' => $user->phone, 'email' => $user->email];

            
            if ($hash == 0) {
                return $this->error_message('wrong password');
            } elseif (!$data) {
                return $this->error_message('not found');
            } else {
                $token = $user->createToken(time())->plainTextToken;
                $arr = ['token' => $token];
                $data_with_token = array_merge($data, $arr);
                return $this->success('success', $data_with_token);
            }
        } catch (\Exception $ex) {
            return $this->error();
            // return $ex->getMessage();
        }
    }
    public function logout(Request $request)
    {
      
        
        
        $user = User::find(Auth::id());
        if (!empty($user)) {
            $request->user()->currentAccessToken()->delete();
        }
        else{
            return response()->json([
                "message" => "User Not Found"
            ]);
        }
        return response()->json([
            "message" => "Logout successful"
        ]);
    }
}
