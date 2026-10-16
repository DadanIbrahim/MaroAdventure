<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArticleController extends Controller
{
    /**
     * Halaman daftar artikel petualangan (Tips, Gunung, Budaya, Destinasi).
     */
    public function index(Request $request): View
    {
        $category = $request->get('kategori');
        $search = $request->get('cari');

        $query = Article::published()->onlyArticles()->latest('published_at');

        if ($category && in_array($category, Article::articleCategories())) {
            $query->category($category);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $articles = $query->paginate(9)->withQueryString();
        $categories = Article::articleCategories();

        // Artikel terbaru untuk sidebar
        $latestArticles = Article::published()
            ->onlyArticles()
            ->latest('published_at')
            ->take(4)
            ->get();

        return view('artikel.index', compact(
            'articles',
            'categories',
            'category',
            'search',
            'latestArticles'
        ));
    }

    /**
     * Halaman daftar berita & pengumuman resmi Maro Adventure.
     */
    public function berita(Request $request): View
    {
        $search = $request->get('cari');

        $query = Article::published()->onlyBerita()->latest('published_at');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $news = $query->paginate(9)->withQueryString();

        // Berita terbaru untuk sidebar / highlight
        $latestNews = Article::published()
            ->onlyBerita()
            ->latest('published_at')
            ->take(4)
            ->get();

        return view('berita.index', compact(
            'news',
            'search',
            'latestNews'
        ));
    }

    /**
     * Halaman detail artikel.
     */
    public function show(string $slug): View
    {
        $article = Article::published()
            ->where('slug', $slug)
            ->firstOrFail();

        // Tambah view count
        $article->increment('views');

        // Artikel terkait
        $related = Article::published()
            ->where('category', $article->category)
            ->where('id', '!=', $article->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        // Artikel terbaru untuk sidebar (sesuai tipe)
        $latestArticles = $article->category === 'Berita'
            ? Article::published()->onlyBerita()->where('id', '!=', $article->id)->latest('published_at')->take(4)->get()
            : Article::published()->onlyArticles()->where('id', '!=', $article->id)->latest('published_at')->take(4)->get();

        return view('artikel.show', compact('article', 'related', 'latestArticles'));
    }

    /**
     * Halaman detail berita (alias spesifik untuk rute /berita/{slug}).
     */
    public function showBerita(string $slug): View
    {
        return $this->show($slug);
    }
}
