@extends('layouts.index', ['title' => 'Modul', 'page_heading' => 'Insert Data'])

@section('content')
<section class="row">
	<div class="col card px-3 py-3">

	<div class="my-3 p-3 rounded">
        
		<!-- Table untuk memanggil data dari database -->
		<form class="mb-5" action="/dashboard" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <input type="hidden" value="0" name="views">
              <label for="title" class="form-label">Title</label>
              <input type="text" autofocus value="{{ old('title') }}" name="title" placeholder="Title" class="form-control @error('title') is-invalid @enderror" id="title">
              @error('title')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror

            </div>
            <div class="mb-3">
              <label for="slug" class="form-label">Slug</label>
              <input type="text" name="slug" value="{{ old('slug') }}" placeholder="Slug" readonly class="form-control @error('slug') is-invalid @enderror" id="slug" required>
              @error('slug')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="image" class="form-label">Post Image</label>
              <img class="img-preview img-fluid mb-3 col-sm-5">
              <input class="form-control @error('image') is-invalid @enderror" onchange="previewImage()" type="file" id="image" name="image" accept="image/png, image/gif, image/jpeg, image/webp" required>
              @error('image')
                {{ $message }}
              @enderror
            </div>
            <div class="mb-3">
              <label for="slug" class="form-label">Content</label>
              @error('description')
                <p class="text-danger">{{ $message }}</p>
              @enderror
              <textarea name="description" id="description" >{{ old("description") }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Create Post</button>
            <a class="btn btn-danger" href="/dashboard">Back</a>
        </form>
			
		{{-- Menampilkan total pemasukan --}}
		<div class="d-flex align-items-end flex-column p-2 mb-2">
			{{-- <p class="h4 p-3 rounded fw-bolder">Total Pemasukan : Rp. {{ $totalPemasukan }}</p> --}}
		</div>
		{{-- Paginator --}}
		{{-- {{ $data->withQueryString()->links() }} --}}
  </div>
</div>

</section>

 <script src="https://cdn.ckeditor.com/4.22.1/full-all/ckeditor.js"></script>
    <script>
      const title = document.querySelector('#title');
      const slug = document.querySelector('#slug');

      title.addEventListener('change', function(){
        fetch('/dashboard/checkSlug?title='+ title.value,{
          headers : {
            'Content-Type' : 'application/json',
            'Accept' : 'application/json'
          }
        })
          .then(response => response.json())
          .then(data => slug.value = data.slug) 
      });

      CKEDITOR.replace( 'description' );

      function previewImage(){
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent){
          imgPreview.src = oFREvent.target.result;
        }
      }
    </script>

@endsection