@extends('layouts.index', ['title' => 'Modul', 'page_heading' => 'Data Article'])

@section('content')
<section class="row">
	<div class="col card px-3 py-3">

	<div class="my-3 p-3 rounded">

		
		<!-- TOMBOL TAMBAH DATA -->
		<div class="pb-3 d-flex justify-content-end">
			<!-- Button trigger modal -->
			<a href="/dashboard/create" class="btn btn-success me-2 py-2" >
				+ Insert Data
			</a>
		</div>
        @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
        {{ session('success') }}
        </div>
        @endif
		<!-- Table untuk memanggil data dari database -->
		<table class="table table-hover">
			<thead>
				<tr>
					<th class="col-md-1">No</th>
					<th class="col-md-2">Title</th>
					<th class="col-md-5">Excerpt</th>
					<th class="col-md-1">Image</th>
					<th class="col-md-2">Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($articles as $item)
					<tr>
						<td>{{ $loop->iteration }}</td>
						<td>{{ $item->title }}</td>
						<td>{{ $item->excerpt }}</td>
						<td><a href="{{ env('STORAGE_URL') . $item->image }}" target="_blank"><i class="bi bi-file-earmark-image"></i></a></td>
						<td>
                            <a  href='{{ url('dashboard/'.$item->slug.'/edit') }}' class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                            
							<form onsubmit="return confirm('Apakah anda yakin ingin menghapus data?')" class="d-inline" action="{{ url("dashboard/".$item->slug) }}" method="post">
								@csrf
								@method('DELETE')
								<button type="submit" name="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
							</form>
                            <a class="btn btn-success btn-sm" href="/dashboard/{{ $item->slug }}"><i class="bi bi-eye"></i></a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
			
	
		<div class="d-flex align-items-end flex-column p-2 mb-2">
		
		</div>
		
		{{ $articles->withQueryString()->links() }}
  </div>
</div>

</section>
@endsection
