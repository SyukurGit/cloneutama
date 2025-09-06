{{-- resources/views/admin/facilities/edit.blade.php --}}

@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Edit Fasilitas</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route('facilities.update', $facility->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="title">Judul Fasilitas</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $facility->title) }}" required>
                    </div>
                    <div class="form-group">
                        <label>Gambar Saat Ini</label>
                        <div>
                            <img src="{{ asset('storage/' . $facility->image_path) }}" alt="{{ $facility->title }}" style="width: 200px; height: auto;">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="image">Ganti Gambar (Opsional)</label>
                        <input type="file" name="image" id="image" class="form-control">
                        <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</small>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('facilities.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection