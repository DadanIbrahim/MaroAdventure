<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ContentCategory;
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
            'sub_category' => 'required|string|max:100',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'is_published' => 'required|boolean',
            'published_at' => 'nullable|date',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:15360',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:15360',
        ]);

        ContentCategory::firstOrCreate([
            'name' => trim($request->sub_category),
            'type' => 'berita',
        ]);

        $data = $request->except(['thumbnail', 'gallery']);
        $data['category'] = 'Berita';
        $data['slug'] = Article::generateUniqueSlug($request->title);

        if (empty($data['excerpt'])) {
            $data['excerpt'] = Str::limit(strip_tags($data['content']), 160);
        }

        if ($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()) {
            $data['thumbnail'] = $this->storePublicFile($request->file('thumbnail'), 'articles');
        }

        if ($request->hasFile('gallery')) {
            $galleryPaths = [];
            foreach ($request->file('gallery') as $file) {
                if ($file && $file->isValid()) {
                    $galleryPaths[] = $this->storePublicFile($file, 'articles/gallery');
                }
            }
            if (! empty($galleryPaths)) {
                $data['gallery'] = $galleryPaths;
            }
        }

        if (! $data['is_published']) {
            $data['published_at'] = null;
        } elseif ($request->filled('published_at')) {
            $data['published_at'] = $request->published_at;
        } elseif (empty($data['published_at'])) {
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
            'sub_category' => 'required|string|max:100',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'is_published' => 'required|boolean',
            'published_at' => 'nullable|date',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:15360',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:15360',
            'deleted_gallery' => 'nullable|array',
            'deleted_gallery.*' => 'nullable|string',
        ]);

        ContentCategory::firstOrCreate([
            'name' => trim($request->sub_category),
            'type' => 'berita',
        ]);

        $data = $request->except(['thumbnail', 'gallery', 'deleted_gallery']);
        $data['category'] = 'Berita';

        if (empty($data['excerpt'])) {
            $data['excerpt'] = Str::limit(strip_tags($data['content']), 160);
        }

        if ($article->title !== $request->title) {
            $data['slug'] = Article::generateUniqueSlug($request->title, $article->id);
        }

        if ($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()) {
            if ($article->thumbnail && ! Str::startsWith($article->thumbnail, ['http://', 'https://', 'assets/', 'images/'])) {
                Storage::disk('public')->delete($article->thumbnail);
            }
            $data['thumbnail'] = $this->storePublicFile($request->file('thumbnail'), 'articles');
        }

        $existingGallery = is_array($article->gallery) ? $article->gallery : (json_decode($article->gallery ?? '[]', true) ?: []);
        $galleryChanged = false;

        if ($request->filled('deleted_gallery')) {
            $toDelete = (array) $request->input('deleted_gallery');
            foreach ($toDelete as $delPath) {
                if ($delPath) {
                    if (! Str::startsWith($delPath, ['http://', 'https://', 'assets/', 'images/']) && Storage::disk('public')->exists($delPath)) {
                        Storage::disk('public')->delete($delPath);
                    }
                    $existingGallery = array_values(array_filter($existingGallery, fn ($p) => $p !== $delPath));
                    $galleryChanged = true;
                }
            }
        }

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                if ($file && $file->isValid()) {
                    $existingGallery[] = $this->storePublicFile($file, 'articles/gallery');
                    $galleryChanged = true;
                }
            }
        }

        if ($galleryChanged) {
            $data['gallery'] = $existingGallery;
        }

        if (! $data['is_published']) {
            $data['published_at'] = null;
        } elseif ($request->filled('published_at')) {
            $data['published_at'] = $request->published_at;
        } elseif (! $article->published_at) {
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
