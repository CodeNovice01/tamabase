{{-- resources/views/news/index.blade.php などで Livewire コンポーネントを読み込んでいるよ --}}
@extends('layouts.top-style')

@section('content')
    {{-- Livewire の NewsBrowser コンポーネントを表示するよ --}}
    @livewire('news-browser')
@endsection
