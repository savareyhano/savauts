<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\D111811059_news;
use Illuminate\Support\Facades\Validator;

class D111811059_newsController extends Controller
{
    //

    public function index()
    {
        $news = D111811059_news::latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'List Data news',
            'data' => $news
        ], 200);

    }

    public function show($id)
    {
        $news = D111811059_news::findOrfail($id);

        return response()->json([
            'success' => true,
            'message' => 'Detail Data news',
            'data' => $news
        ], 200);

    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'img_url' => 'required',
            'sub_desc' => 'required',
            'desc' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $news = D111811059_news::create([
            'title' => $request->title,
            'img_url' => $request->img_url,
            'sub_desc' => $request->sub_desc,
            'desc' => $request->desc
        ]);

        if($news) {
            return response()->json([
                'success' => true,
                'message' => 'news Created',
                'data' => $news
            ], 201);
        }
    }

    public function update(Request $request, D111811059_news $news)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'img_url' => 'required',
            'sub_desc' => 'required',
            'desc' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $news = D111811059_news::findOrfail($post->id);
        if($news) {
            $news->update([
                'title' => $request->title,
                'img_url' => $request->img_url,
                'sub_desc' => $request->sub_desc,
                'desc' => $request->desc
            ]);
            return response()->json([
                'success' => true,
                'message' => 'news Updated',
                'data' => $news
            ], 200);
        }
    }

    public function destroy($id)
    {
        $news = D111811059_news::findOrfail($id);

        if($news) {
            $news->delete();

            return response()->json([
                'success' => true,
                'message' => 'news Deleted',
            ], 200);

        }

        return response()->json([
            'success' => false,
            'message' => 'news Not Found',
        ], 404);
    }
}
