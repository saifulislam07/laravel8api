<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserApiController extends Controller
{
    public function showUser($id = null)
    {
        if ($id == '') {
            $users = User::get();
            return response()->json(['users' => $users], 200);
        } else {
            $users = User::find($id);
            return response()->json(['users' => $users], 200);
        }
    }

    public function addUser(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            //   return $data;

            $rules = [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required',
            ];

            $customMessage = [
                'name.required' => 'Name is required',
                'email.required' => 'Email is required',
                'email.email' => 'Email must be valid Email',
                'password.required' => 'Password is required',
            ];

            $validator = Validator::make($data, $rules, $customMessage);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $user = new User();
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = bcrypt($data['password']);
            $user->save();
            $message = 'User Successfully Added';
            return response()->json(['message' => $message], 201);
        }
    }


    public function addMultipleUser(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            //   return $data;

            $rules = [
                'users.*.name' => 'required',
                'users.*.email' => 'required|email|unique:users',
                'users.*.password' => 'required',
            ];

            $customMessage = [
                'users.*.name.required' => 'Name is required',
                'users.*.email.required' => 'Email is required',
                'users.*.email.email' => 'Email must be valid Email',
                'users.*.password.required' => 'Password is required',
            ];

            $validator = Validator::make($data, $rules, $customMessage);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            foreach ($data['users'] as $euser) {
                $user = new User();
                $user->name = $euser['name'];
                $user->email = $euser['email'];
                $user->password = bcrypt($euser['password']);
                $user->save();
                $message = 'User Successfully Added';
            }
            return response()->json(['message' => $message], 201);
        }
    }

    public function updateUserDetails(Request $request, $id)
    {
        if ($request->isMethod('put')) {
            $data = $request->all();

            $rules = [
                'name' => 'required',
                'password' => 'required',
            ];

            $customMessage = [
                'name.required' => 'Name is required',
                'password.required' => 'Password is required',
            ];

            $validator = Validator::make($data, $rules, $customMessage);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $user = User::findOrfail($id);
            $user->name = $data['name'];
            $user->password = bcrypt($data['password']);
            $user->save();
            $message = 'User Details Successfully Updated';
            return response()->json(['message' => $message], 202);
        }
    }
    public function updateSingleRecord(Request $request, $id)
    {
        if ($request->isMethod('patch')) {
            $data = $request->all();

            $rules = [
                'name' => 'required',

            ];

            $customMessage = [
                'name.required' => 'Name is required',

            ];

            $validator = Validator::make($data, $rules, $customMessage);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $user = User::findOrfail($id);
            $user->name = $data['name'];

            $user->save();
            $message = 'User single Details Successfully Updated';
            return response()->json(['message' => $message], 202);
        }
    }


    public function deleteSingleRecord($id = null)
    {
        User::findOrFail($id)->delete();
        $message = 'Delete single data Successfully ';
        return response()->json(['message' => $message], 200);
    }
    public function deleteSingleRecordByJson(Request $request)
    {

        if ($request->isMethod('delete')) {
            $data = $request->all();
            User::where('id', $data['id'])->delete();
            $message = 'Delete single data by json Successfully ';
            return response()->json(['message' => $message], 200);
        }
    }
    public function deleteMultipleRecord($ids = null)
    {
        $ids = explode(',', $ids);
        User::whereIn('id', $ids)->delete();
        $message = 'Delete Multiple data Successfully ';
        return response()->json(['message' => $message], 200);
    }

    public function deleteMultipleRecordByJson(Request $request)
    {
        if ($request->isMethod('delete')) {
            $data = $request->all();
            User::whereIn('id', $data['ids'])->delete();
            $message = 'Delete Multiple data with json Successfully ';
            return response()->json(['message' => $message], 200);
        }
    }
}
