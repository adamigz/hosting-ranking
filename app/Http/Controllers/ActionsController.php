<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\Vote;
use App\Models\Comment;
use App\Models\Rate;
use App\Models\Hosting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class ActionsController extends Controller
{
    public function vote($id, Request $request)
    {
        Validator::make(['id' => $id], [
            'id' => 'required|integer|exists:hostings,id'
        ])->validate();

        $cookie = $request->cookie($id);
        
        $hosting = Hosting::find($id);

        if ($request->cookie($id)) {
            $vote = Vote::where('hosting_id', $id)->first();
            $vote->forceDelete();
            
            Cookie::queue(Cookie::forget($id));

            $hosting->votes_count--;
            $hosting->save();

            return redirect()->back();
        } else {
            Vote::create([
                'hosting_id' => $id
            ]);

            Cookie::queue($id, true, 60*24*3);

            $hosting->votes_count++;
            $hosting->save();

            return redirect()->back();
        }
    }
    public function addComment($id, Request $request)
    {
        Validator::make(['id' => $id], [
            'id' => 'required|integer|exists:hostings,id'
        ])->validate();
        
        $validated = $request->validate([
            'content' => 'required|string',
            'rate' => 'integer'
        ]);
        
        $comment = Comment::create([
            'content' => $request->input('content'),
            'user_id' => $request->user()->id,
            'hosting_id' => $id
        ]);

        if ($request->input('rate')+0 > 0) {
            Rate::create([
                'value' => $request->input('rate')+0, 
                'user_id' => $request->user()->id,
                'comment_id' => $comment->id
            ]);
        }

        return redirect()->back();
    }
}
