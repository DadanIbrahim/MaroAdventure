<?php

namespace App\Http\Controllers;

use App\Models\CommunityPost;
use Illuminate\Http\Request;

class BackendCommunityController extends Controller
{
    public function index()
    {
        $posts = CommunityPost::with('user')->latest()->get();
        return view('superadmin.community', compact('posts'));
    }

    public function destroy($id)
    {
        $post = CommunityPost::findOrFail($id);
        $post->delete();

        return redirect()->back()->with('success', 'Postingan komunitas berhasil dihapus!');
    }
}

