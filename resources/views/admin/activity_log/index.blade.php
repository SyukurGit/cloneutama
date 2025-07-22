@extends('layouts.admin')
@section('title', 'Riwayat Log Aktivitas')
@section('header', 'Riwayat Log Aktivitas')

@section('content')
<div class="space-y-8">
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
        <h3 class="text-lg font-bold text-gray-800 border-b pb-3 mb-4 flex items-center gap-3">
            <i class="fas fa-bolt text-red-600"></i>
            Aktivitas Terbaru Sistem
        </h3>
        <div class="space-y-4">
            @forelse($recentActivities as $activity)
                <div class="flex items-start gap-4 p-3 rounded-lg hover:bg-gray-50">
                    <div class="flex-shrink-0 w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                        {{-- Logika untuk ikon berdasarkan aksi --}}
                        @if($activity->event === 'created')
                            <i class="fas fa-plus-circle text-green-600"></i>
                        @elseif($activity->event === 'updated')
                            <i class="fas fa-pencil-alt text-yellow-600"></i>
                        @elseif($activity->event === 'deleted')
                            <i class="fas fa-trash-alt text-red-600"></i>
                        @else
                            <i class="fas fa-info-circle text-gray-600"></i>
                        @endif
                    </div>
                    <div>
                        <p class="text-sm text-gray-800">
                            <strong class="font-semibold">{{ optional($activity->causer)->name ?? 'Sistem' }}</strong>
                            {{-- Mengubah deskripsi menjadi lebih dinamis --}}
                            telah <strong>{{ $activity->event }}</strong> data {{ Str::of(class_basename($activity->subject_type))->snake(' ')->replace('_', ' ') }}: 
                            <span class="italic text-gray-600">"{{ optional($activity->subject)->title ?? optional($activity->subject)->name ?? '' }}"</span>
                        </p>
                        <p class="text-xs text-gray-500">{{ $activity->created_at->diffForHumans() }} ({{ $activity->created_at->format('d M Y, H:i') }})</p>
                    </div>
                </div>
            @empty
                <p class="text-sm text-gray-500 text-center py-4">Belum ada aktivitas yang tercatat.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection