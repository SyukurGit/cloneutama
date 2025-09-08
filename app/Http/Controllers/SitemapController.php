<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; // <-- Pastikan ini ada
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\News;

class SitemapController extends Controller
{
    /**
     * Membuat dan menampilkan sitemap.xml
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function generate(Request $request) // <-- PERBAIKAN: Tambahkan Request $request di sini
    {
        $sitemap = Sitemap::create()
            ->add(Url::create('/')->setPriority(1.0)->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY))
            ->add(Url::create('/profile')->setPriority(0.8)->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY))
            ->add(Url::create('/berita')->setPriority(0.9)->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY))
            ->add(Url::create('/thesis-schedule')->setPriority(0.7)->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY));

        // Tambahkan semua berita ke sitemap
        News::all()->each(function (News $news) use ($sitemap) {
            $sitemap->add(Url::create("/berita/{$news->slug}")->setLastModificationDate($news->updated_at));
        });

        // Sekarang variabel $request sudah ada dan bisa digunakan
        return $sitemap->toResponse($request);
    }
}