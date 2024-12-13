@extends('layouts.index', ['title' => 'Modul', 'page_heading' => 'Data Article'])

@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h1 class="mb-5 mt-3">{{ $article->title }}</h1>

                <a class="btn btn-success" href="/dashboard"><span data-feather="arrow-left"></span>Back to all my posts</a>
                <a class="btn btn-warning" href="/dashboard/{{ $article->slug }}/edit"><span data-feather="edit"></span>Edit</a>
                <form class="d-inline" action="/dashboard/{{ $article->slug }}" method="POST">
                    @method('delete')
                    @csrf
                    <button class="btn btn-danger" onclick="return confirm('Aare you sure?')"><span data-feather="x-circle"></span>Delete</button>
                 </form>
                
                 @if ($article->image !== 'kosong')
                 <div style="max-height: 600px; overflow: hidden;"> <!-- Overflow itu kl misalnya bablas ngelebihin max-height nya -->
                     <img src="{{ env('STORAGE_URL') . $article->image }}" class="img-fluid mt-2" alt="{{ $article->title }}">
                 </div>
                 @else
                 <img src="https://source.unsplash.com/1200x600?programming" class="img-fluid mt-2" alt="{{ $article->title }}">
                 @endif
                <article class="my-3 fs-6">
                    {!! $article->description !!}  {{-- Supaya tag html tetep jalan, jadi tag htmlnya gajadi text biasa --}}
                </article>
            </div>
        </div>
    </div>
@endsection
