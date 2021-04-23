<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\D111811059_admin;
use Illuminate\Support\Facades\Validator;

class D111811059_adminController extends Controller
{
    //

    public function index()
    {
        $admin = D111811059_admin::latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'List Data admin',
            'data' => $admin
        ], 200);

    }

    public function show($id)
    {
        $admin = D111811059_admin::findOrfail($id);

        return response()->json([
            'success' => true,
            'message' => 'Detail Data admin',
            'data' => $admin
        ], 200);

    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $admin = D111811059_admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);

        if($admin) {
            return response()->json([
                'success' => true,
                'message' => 'admin Created',
                'data' => $admin
            ], 201);
        }
    }

    public function update(Request $request, D111811059_admin $admin)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $admin = D111811059_admin::findOrfail($post->id);
        if($admin) {
            $admin->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password
            ]);
            return response()->json([
                'success' => true,
                'message' => 'admin Updated',
                'data' => $admin
            ], 200);
        }
    }

    public function destroy($id)
    {
        $admin = D111811059_admin::findOrfail($id);

        if($admin) {
            $admin->delete();

            return response()->json([
                'success' => true,
                'message' => 'admin Deleted',
            ], 200);

        }

        return response()->json([
            'success' => false,
            'message' => 'admin Not Found',
        ], 404);
    }
}
