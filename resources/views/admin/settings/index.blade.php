@extends('layouts.admin')

@section('title', 'Director Greeting Settings')
@section('header', 'Director Greeting Settings')

@section('content')
<div class="container mx-auto px-4 py-6">
    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-lg mb-6 shadow-sm flex items-center" role="alert">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <form action="{{ route('admin.director_settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-white flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Director's Greeting Content
                </h2>

                {{-- =============================================== --}}
                {{--           INI ADALAH TOMBOL SWITCH BARU         --}}
                {{-- =============================================== --}}
                <div x-data="{ enabled: {{ old('director_greeting_enabled', $settings['director_greeting_enabled'] ?? 'on') === 'on' ? 'true' : 'false' }} }">
                    <label for="director_greeting_enabled" class="flex items-center cursor-pointer">
                        <span class="mr-3 text-sm font-medium text-white">Show Section</span>
                        <div class="relative">
                            <input id="director_greeting_enabled" name="director_greeting_enabled" type="checkbox" class="sr-only" x-model="enabled" value="on">
                            <div class="block bg-gray-200 w-14 h-8 rounded-full"></div>
                            <div class="dot absolute left-1 top-1 bg-white w-6 h-6 rounded-full transition-transform" :class="{ 'translate-x-6 !bg-green-400': enabled }"></div>
                        </div>
                    </label>
                </div>
                {{-- =============================================== --}}
                {{--              AKHIR TOMBOL SWITCH                --}}
                {{-- =============================================== --}}
            </div>

            <div class="p-6 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label for="director_greeting_title_en" class="block text-sm font-medium text-gray-700">
                            Top Title
                        </label>
                        <input type="text" name="director_greeting_title_en" id="director_greeting_title_en" 
                               value="{{ old('director_greeting_title_en', $settings['director_greeting_title_en'] ?? '') }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                               placeholder="e.g. --A WORD FROM THE DIRECTOR--">
                    </div>
                    
                    <div class="space-y-2">
                        <label for="director_name_en" class="block text-sm font-medium text-gray-700">
                            Director's Name
                        </label>
                        <input type="text" name="director_name_en" id="director_name_en" 
                               value="{{ old('director_name_en', $settings['director_name_en'] ?? '') }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                               placeholder="Enter the director's name">
                    </div>
                </div>

                <div class="space-y-2">
                    <label for="director_position_en" class="block text-sm font-medium text-gray-700">
                        Director's Position
                    </label>
                    <input type="text" name="director_position_en" id="director_position_en" 
                           value="{{ old('director_position_en', $settings['director_position_en'] ?? '') }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                           placeholder="Enter the director's position">
                </div>

                <div class="space-y-2">
                    <label for="director_greeting_intro_en" class="block text-sm font-medium text-gray-700">
                        Greeting Intro
                    </label>
                    <input type="text" name="director_greeting_intro_en" id="director_greeting_intro_en" 
                           value="{{ old('director_greeting_intro_en', $settings['director_greeting_intro_en'] ?? '') }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                           placeholder="Enter the greeting intro">
                </div>

                <div class="space-y-2">
                    <label for="director_greeting_body_en" class="block text-sm font-medium text-gray-700">
                        Greeting Body
                    </label>
                    <textarea name="director_greeting_body_en" id="director_greeting_body_en" rows="4" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-none"
                              placeholder="Enter the director's greeting message">{{ old('director_greeting_body_en', $settings['director_greeting_body_en'] ?? '') }}</textarea>
                </div>

                <div class="space-y-2">
                    <label for="director_greeting_slogan_en" class="block text-sm font-medium text-gray-700">
                        Slogan
                    </label>
                    <input type="text" name="director_greeting_slogan_en" id="director_greeting_slogan_en" 
                           value="{{ old('director_greeting_slogan_en', $settings['director_greeting_slogan_en'] ?? '') }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                           placeholder="Enter slogan with quotes">
                </div>

                <div class="space-y-2">
                    <label for="director_image" class="block text-sm font-medium text-gray-700">
                        Director's Photo
                    </label>
                    <div class="flex items-center space-x-4">
                        <label for="director_image" class="cursor-pointer">
                            <div class="flex items-center justify-center w-full px-4 py-2 border-2 border-gray-300 border-dashed rounded-lg hover:border-blue-400 hover:bg-blue-50 transition-colors">
                                <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span class="text-sm text-gray-600">Choose director's photo</span>
                            </div>
                        </label>
                        <input type="file" name="director_image" id="director_image" class="hidden" accept="image/*">
                    </div>
                    @if(isset($settings['director_image']))
                        <div class="mt-3">
                            <img src="{{ asset('storage/' . $settings['director_image']) }}" 
                                 alt="Director's Photo" 
                                 class="h-24 w-auto rounded-lg shadow-sm border border-gray-200">
                        </div>
                    @endif
                </div>
            </div>

            <div class="bg-gray-50 px-6 py-4 border-t border-gray-100">
                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 px-6 rounded-lg transition-colors shadow-sm flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Save Changes
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection