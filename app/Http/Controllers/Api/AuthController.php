<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Otp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    //Register
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'phone'    => 'required|digits:9',
            // 'email'    => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $user_count = User::wherephone($request->phone)->count();

        if ($user_count > 0) {
            return $this->success('already_have_account', []);
        }

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'password' => bcrypt($request->password),
            // 'role_id'  => 1,
        ]);

        $token = $user->createToken('authToken')->plainTextToken;
        return $this->success('success', ['token' => $token]);
    }


    //Login
    public function login(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'phone'    => 'required|exists:users',
                'password' => 'required',
            ],
        );


        if ($validator->fails()) {
            return $this->error_message('request parameters wrong');
        }
        try {

            $user = User::where('status', 1)->where('phone', $request->phone)->first();
            $hash = Hash::check($request->password, $user->password);

            $data = ['id' => $user->id, 'name' => $user->name, 'phone' => $user->phone];


            if ($hash == 0) {
                return $this->error_message('wrong password');
            } elseif (!$data) {
                return $this->error_message('not found');
            } else {
                $token = $user->createToken(time())->plainTextToken;
                $arr = ['token' => $token, 'role_id' => $user->role_id];
                $data_with_token = array_merge($data, $arr);
                return $this->success('success', $data_with_token);
            }
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    //- 1
    public function forgotpassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|digits:9',
        ]);

        $identity = $request['phone'];

        if ($validator->fails()) {
            return response()->json([
                "message" => "    phone number requir",
            ], 400);
        }

        /*
         if user call this api many time the otp will be creating
         one more time for the same phone nummber 
         so must be deleted before creating another one. -_-
        */
        DB::table('otp')->where('phone', $identity)->delete();

        $user = User::where('phone', $identity)->first();
        if (isset($user)) {

            $token = rand(100000, 999999);
            DB::table('otp')->insert([
                'phone'      => $user['phone'],
                'otp'        => $token,
                'created_at' => now(),
            ]);
            return response()->json([
                "error"   => false,
                "data"    => $token,
                "message" => "OTP verification successful"
            ]);
        }

        return response()->json([
            "error" => true,
            "data" => [],
            "message" => "phone not found"
        ]);
    }

    //- 2
    public function verification_password_otp(Request $request)
    {
        $rules = array(
            'phone'   => 'required|regex:/^[0-9]+$/',
            'otp'     => 'required',
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'error'   => true,
                "data"    => [],
                'message' => $validator->messages()->first()
            ]);
        }
        $identity = $request['phone'];

        $data = Otp::where(['otp' => $request['otp']])
            ->where('phone', $identity)
            ->first();

        if (isset($data)) {
            $data->delete();
            return response()->json([
                'error'   => false,
                "data"    => [],
                'message' => 'Otp_verified'
            ]);
        }

        return response()->json([
            'error'   => true,
            "data"    => [],
            'message' => 'otp_not_found'
        ]);
    }

    //- 3
    public function reset_password(Request $request)
    {
        $rules = array(
            'phone'    => 'required|regex:/^[0-9]+$/',
            'password' => 'required',
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'error'  => true,
                "data"   => [],
                'message' => $validator->messages()->first()
            ]);
        }
        $identity = $request['phone'];
        DB::table('users')->where('phone', $identity)
            ->update([
                'password' => bcrypt(str_replace(' ', '', $request['password']))
            ]);
        return response()->json([
            "error"  => false,
            "data"    => [],
            "message" => "Password changed successfully"
        ]);
    }
}
