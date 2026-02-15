<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCommentRequest;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddCommentRequest $request)
    {
        $cred = $request->validated();
        $request->user()->comments()->create($cred);
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
