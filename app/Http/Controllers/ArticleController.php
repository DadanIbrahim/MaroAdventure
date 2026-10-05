<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Halaman daftar semua artikel dengan filter kategori & pencarian.
     */
    public function index(Request $request)
    {
        $category = $request->get('kategori');
        $search = $request->get('cari');

        $query = Article::published()->latest('published_at');

        if ($category && in_array($category, Article::allCategories())) {
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
        $categories = Article::allCategories();

        // Artikel terbaru untuk sidebar
        $latestArticles = Article::published()
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
     * Halaman detail artikel.
     */
    public function show(string $slug)
    {
        $article = Article::published()
            ->where('slug', $slug)
            ->firstOrFail();

        // Tambah view count
        $article->increment('views');

        // Artikel terkait (kategori sama, bukan artikel ini)
        $related = Article::published()
            ->where('category', $article->category)
            ->where('id', '!=', $article->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        // Artikel terbaru untuk sidebar
        $latestArticles = Article::published()
            ->where('id', '!=', $article->id)
            ->latest('published_at')
            ->take(4)
            ->get();

        return view('artikel.show', compact('article', 'related', 'latestArticles'));
    }
}
