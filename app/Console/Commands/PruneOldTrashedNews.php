<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\Models\News;
use Illuminate\Support\Carbon;

class PruneOldTrashedNews extends Command
{
    protected $signature = 'news:prune-trashed';
    protected $description = 'Permanently delete news that has been in the trash for over 48 hours.';

    public function handle()
    {
        $this->info('Mencari berita di tong sampah yang lebih dari 48 jam...');
        $cutoffDate = Carbon::now()->subHours(48);

        $newsToDelete = News::onlyTrashed()->where('deleted_at', '<=', $cutoffDate)->get();

        if ($newsToDelete->isEmpty()) {
            $this->info('Tidak ada berita yang perlu dihapus.');
            return;
        }

        foreach ($newsToDelete as $news) {
            if ($news->image && $news->image !== 'images/default-news.jpg') {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($news->image);
            }
            $news->forceDelete();
            $this->line("Berita '{$news->title}' telah dihapus permanen.");
        }

        $this->info('Selesai.');
    }
}