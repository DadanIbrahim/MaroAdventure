<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BackendBeritaController extends Controller
{
    public function index()
    {
        $news = Article::onlyBerita()->latest()->get();

        return view('backend.berita.index', compact('news'));
    }

    public function create()
    {
        return view('backend.berita.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'is_published' => 'required|boolean',
            'published_at' => 'nullable|date',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->except(['thumbnail', 'gallery']);
        $data['category'] = 'Berita';
        $data['slug'] = Str::slug($request->title).'-'.uniqid();

        if (empty($data['excerpt'])) {
            $data['excerpt'] = Str::limit(strip_tags($data['content']), 160);
        }

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('articles', 'public');
        }

        if ($request->hasFile('gallery')) {
            $galleryPaths = [];
            foreach ($request->file('gallery') as $file) {
                $galleryPaths[] = $file->store('articles/gallery', 'public');
            }
            $data['gallery'] = $galleryPaths;
        }

        if ($request->filled('published_at')) {
            $data['published_at'] = $request->published_at;
        } elseif ($data['is_published'] && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        Article::create($data);

        $prefix = request()->routeIs('superadmin.*') ? 'superadmin' : 'admin';

        return redirect()->route($prefix.'.berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(Article $article)
    {
        return view('backend.berita.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'is_published' => 'required|boolean',
            'published_at' => 'nullable|date',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->except(['thumbnail', 'gallery']);
        $data['category'] = 'Berita';

        if (empty($data['excerpt'])) {
            $data['excerpt'] = Str::limit(strip_tags($data['content']), 160);
        }

        if ($article->title !== $request->title) {
            $data['slug'] = Str::slug($request->title).'-'.uniqid();
        }

        if ($request->hasFile('thumbnail')) {
            if ($article->thumbnail) {
                Storage::disk('public')->delete($article->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('articles', 'public');
        }

        if ($request->hasFile('gallery')) {
            $existingGallery = is_array($article->gallery) ? $article->gallery : (json_decode($article->gallery ?? '[]', true) ?: []);
            foreach ($request->file('gallery') as $file) {
                $existingGallery[] = $file->store('articles/gallery', 'public');
            }
            $data['gallery'] = $existingGallery;
        }

        if ($request->filled('published_at')) {
            $data['published_at'] = $request->published_at;
        } elseif ($data['is_published'] && ! $article->is_published) {
            $data['published_at'] = now();
        }

        $article->update($data);

        $prefix = request()->routeIs('superadmin.*') ? 'superadmin' : 'admin';

        return redirect()->route($prefix.'.berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Article $article)
    {
        if ($article->thumbnail) {
            Storage::disk('public')->delete($article->thumbnail);
        }
        if (! empty($article->gallery) && is_array($article->gallery)) {
            foreach ($article->gallery as $gFile) {
                Storage::disk('public')->delete($gFile);
            }
        }
        $article->delete();

        $prefix = request()->routeIs('superadmin.*') ? 'superadmin' : 'admin';

        return redirect()->route($prefix.'.berita.index')->with('success', 'Berita berhasil dihapus.');
    }
}
