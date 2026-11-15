<?php

namespace Tests\Feature;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContentListingPageTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @param  array<string, mixed>  $attributes
     */
    private function createArticle(array $attributes = []): Article
    {
        $title = $attributes['title'] ?? fake()->unique()->sentence(4);

        return Article::create(array_merge([
            'title' => $title,
            'slug' => Article::generateUniqueSlug($title),
            'content' => fake()->paragraphs(3, true),
            'category' => 'Tips',
            'is_published' => true,
            'published_at' => now()->subDay(),
        ], $attributes));
    }

    public function test_berita_page_uses_same_card_layout_as_artikel_page(): void
    {
        $this->createArticle(['title' => 'Tips Mendaki Aman', 'category' => 'Tips']);
        $this->createArticle(['title' => 'Kuota Rinjani Dibuka', 'category' => 'Berita', 'sub_category' => 'Pengumuman']);

        $this->get(route('artikel.index'))
            ->assertOk()
            ->assertSee('class="article-card"', false)
            ->assertSee('id="listing-category-pills"', false)
            ->assertSee('Tips Mendaki Aman');

        $this->get(route('berita.index'))
            ->assertOk()
            ->assertSee('class="article-card"', false)
            ->assertSee('id="listing-category-pills"', false)
            ->assertSee('cat-pengumuman', false)
            ->assertSee('Kuota Rinjani Dibuka')
            ->assertDontSee('Tips Mendaki Aman');
    }

    public function test_berita_ajax_request_filters_by_sub_category(): void
    {
        $this->createArticle(['title' => 'Kuota Rinjani Dibuka', 'category' => 'Berita', 'sub_category' => 'Pengumuman']);
        $this->createArticle(['title' => 'Bersih Gunung Bersama', 'category' => 'Berita', 'sub_category' => 'Kegiatan']);

        $this->get(route('berita.index', ['kategori' => 'Kegiatan']), ['X-Requested-With' => 'XMLHttpRequest'])
            ->assertOk()
            ->assertDontSee('<html', false)
            ->assertSee('Bersih Gunung Bersama')
            ->assertDontSee('Kuota Rinjani Dibuka');
    }
}
