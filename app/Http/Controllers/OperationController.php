<?php

namespace App\Http\Controllers;

use App\Models\Beat;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class OperationController extends Controller
{
    //
    public function createPost(Request $request)
    {
        $formfields = $request->validate([
            'slug' => ['required', Rule::unique('posts', 'slug')],
            'content' => 'required',
        ]);

        Post::create($formfields);
        return response()->json(['message' => 'Post Created Sucessfully'], 200);
    }


    /**
     * createBeat
     *
     * @param  mixed $request
     * @return void
     * 
     * please run php artisan storage:link
     * To link the storage to the file
     */
    public function createBeat(Request $request)
    {
        $formfields = $request->validate([
            'slug' => ['required', Rule::unique('beats', 'slug')],
            'title' => 'required',
            'free_file' => ['required', File::types(['mp3', 'mp4', 'wav'])->min(200)->max(12 * 1024)]
        ]);
        if ($request->hasFile('free_file')) {
            $formfields['free_file'] = $request->file('free_file')->store('files', 'public');
        }

        Beat::create($formfields);
        return response()->json(['message' => 'Beat Created Sucessfully'], 200);
    }

    public function createLikePost($post, Request $request)
    {
        $posting = Post::findOrFail($post);
        $like = new Like();
        $like->likeable()->associate($posting);
        //Since auth user does not exist at first we can use what is taken from the request
        $like->user_id = auth()->id() ?? $request->user_id ?? 1;
        $like->save();

        return response()->json(['message' => 'Post Liked Sucessfully', 'like' => $like], 200);
    }

    public function createLikeBeat(Beat $beat, Request $request)
    {
        $like = new Like();
        $like->likeable()->associate($beat);
        //Since auth user does not exist at first we can use what is taken from the request
        $like->user_id = auth()->id() ?? $request->user_id ?? 1;
        $like->save();

        return response()->json(['message' => 'Beat Liked Sucessfully', 'like' => $like], 200);
    }
}
