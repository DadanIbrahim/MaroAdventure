<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ContentCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class BackendCategoryController extends Controller
{
    public function index(): View
    {
        $articleCategories = ContentCategory::artikel()->orderBy('name')->get();
        $beritaCategories = ContentCategory::berita()->orderBy('name')->get();

        // Hitung jumlah artikel / berita per kategori
        $articleCounts = Article::onlyArticles()
            ->selectRaw('category, COUNT(*) as total')
            ->groupBy('category')
            ->pluck('total', 'category');

        $beritaCounts = Article::onlyBerita()
            ->selectRaw('sub_category, COUNT(*) as total')
            ->groupBy('sub_category')
            ->pluck('total', 'sub_category');

        return view('backend.categories.index', compact(
            'articleCategories',
            'beritaCategories',
            'articleCounts',
            'beritaCounts'
        ));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('content_categories')->where(fn ($q) => $q->where('type', $request->type)),
            ],
            'type' => 'required|in:artikel,berita',
        ], [
            'name.unique' => 'Kategori ini sudah ada.',
        ]);

        ContentCategory::create([
            'name' => trim($validated['name']),
            'type' => $validated['type'],
        ]);

        return back()->with('success', 'Kategori "'.$validated['name'].'" berhasil ditambahkan.');
    }

    public function update(Request $request, ContentCategory $category): RedirectResponse
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('content_categories')
                    ->where(fn ($q) => $q->where('type', $category->type))
                    ->ignore($category->id),
            ],
        ], [
            'name.unique' => 'Nama kategori sudah digunakan.',
        ]);

        $oldName = $category->name;
        $newName = trim($validated['name']);

        $category->update(['name' => $newName]);

        // Sinkronkan nama kategori pada artikel/berita yang sudah ada
        if ($oldName !== $newName) {
            if ($category->type === 'artikel') {
                Article::onlyArticles()->where('category', $oldName)->update(['category' => $newName]);
            } else {
                Article::onlyBerita()->where('sub_category', $oldName)->update(['sub_category' => $newName]);
            }
        }

        return back()->with('success', 'Kategori berhasil diperbarui menjadi "'.$newName.'".');
    }

    public function destroy(ContentCategory $category): RedirectResponse
    {
        $name = $category->name;
        $category->delete();

        return back()->with('success', 'Kategori "'.$name.'" berhasil dihapus.');
    }
}
