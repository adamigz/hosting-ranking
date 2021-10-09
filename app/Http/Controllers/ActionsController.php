<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\Vote;
use App\Models\Comment;
use App\Models\Rate;
use App\Models\Hosting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class ActionsController extends Controller
{
    public function vote($id, Request $request)
    {
        Validator::make(['id' => $id], [
            'id' => 'required|integer|exists:hostings,id'
        ])->validate();

        $hosting = Hosting::find($id);

        if (Cookie::get($id)) {
            $vote = Vote::where('hosting_id', $id, 'AND', 'uid', Cookie::get('uid'.$id))->first();
            $vote->forceDelete();
            
            Cookie::queue(Cookie::forget($id));
            Cookie::queue(Cookie::forget('uid'.$id));

            $hosting->votes_count--;
            $hosting->save();

            return redirect()->back();
        } else {
            $hash = Hash::make(now());

            Vote::create([
                'hosting_id' => $id, 
                'uid' => $hash
            ]);

            Cookie::forever($id, true);
            Cookie::forever('uid'.$id, $hash);

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
