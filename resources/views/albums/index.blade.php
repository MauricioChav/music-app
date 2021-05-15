@extends('layouts.master')

@section('content')	


<div class="container my-4">

	<div class="row align-items-center">
	
		<div class="col-md-4">

		<a class="btn btn-primary" href="{{ route('albums.create') }}">Crear Nuevo Álbum</a>
		
		</div>

	
	</div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title green-title-sm" id="exampleModalLabel">Borrar proyecto</h5>
        <button type="button" class="btn-close btn-primary" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
	  
      <div class="row">
      <div class="modal-r-body col-8" style="margin: auto;">
			
			<div class="form-group mb-3">
				<h1>¿Estas seguro de que quieres borrar <span id="deleteName" class="green-title-sm"></span> de la lista de proyectos?</h1>
				<br>
				<h3 class="red-title">Borrar el proyecto también eliminara todas las tareas que pertenezcan al mismo</h3>
				
			</div>
			
			
      </div>
  </div>
      <div class="modal-footer col-8" style="margin: auto;">
		<form id="deleteForm" method="POST" action="">
			{{ csrf_field() }}	
			{{ method_field('DELETE') }}
		<button class="btn btn-danger" type="submit">Borrar</button>
		</form>

        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        
      </div>
	  
	  
    </div>
  </div>
</div>

<div class="container">
	<div class="container-fluid">
    <div class="px-4 mb-5 text-center">
      <h1 class="display-4 fw-bold green-title">Listado de Álbums</h1>
      <div class="col-lg-6 mx-auto">
        <p class="lead mb-4">Estos son tus álbumes creados</p>

        @if(count( $albums ) == 0)
        	<p class="lead mb-4" style="font-weight: bold;
">Áun no existen álbums registradas. Para comenzar añade tu primer álbum:</p>
        @endif

      </div>
      <div class="overflow-hidden" style="max-height: 30vh;">
        <div class="container px-5">
          
        </div>
      </div>
    </div>
</div>

<script type="text/javascript">
	function sendDeleteInfo(id, albumName) {
  		document.getElementById("deleteName").innerHTML = albumName;
  		document.getElementById("deleteForm").action = "{{ route('albums.destroy', "") }}" + "/" + id;
	}
</script>

<div class="row">
	@foreach($albums as $album)
	<div class="col-md-3 mt-4">
			<div class="card">

					<div class="card-body row">
						<a href="{{ route('albums.show', $album->id) }}">
							<img class="cover-opa" alt="{{ $album->name }}_cover" src="{{ asset('storage/album_covers/') }}/{{$album->cover}}" width="100%">
						</a>
						

					</div>

					<div class="line-color" style="height: 8px; width: 100%; background-color:#C90E3F;"></div>

					<div class="row">
						<div class="col-md-9">
							<div class="card-body">
								<h4 class="green-title-sm">{{ $album->name }}</h4>
								<p>{{ $album->artist }}</p>
								<p>{{ $album->year }}</p>
							</div>
							
						</div>

						<div class="col-md-3">
							<div class="card-body">
								<a class="btn btn-sm btn-info mt-2" href="{{ route('albums.show', $album->id) }}"><ion-icon name="create-outline"></ion-icon></a>
								<button class="btn btn-sm btn-danger mt-2" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="sendDeleteInfo({{ $album->id }}, '{{ $album->name }}' )"><ion-icon name="trash-outline"></ion-icon></button>
							</div>
							
						</div>
					</div>
					

					<!--

					<div class="songs">
						<ul>

							@foreach($album->songs as $song)
							<li>
								<div class="row container"> 
							<div class="col-8"> 
								<a class="btn btn-sm
								@php
								if($song->status == 0 && $song->due_date < date("Y-m-d")){
									echo "btn-danger";
								}else{
									echo "btn-primary";
								}
							@endphp

								 " href="{{ route('songs.show', $song->id) }}">{{$song->name}}
								 @php
								if($song->status == 0 && $song->due_date < date("Y-m-d")){
									echo "(Vencida)";
								}
							@endphp
								</a>
							</div>

							<div class="col-4 mb-4" style="text-align: right; color: 
							@php
								if($song->status == 0 && $song->due_date < date("Y-m-d")){
								echo "red";
							}else{
								echo "#17C117";
						}
							@endphp

							"> 
								<p>{{ $song->due_date }}</p>
							</div>
						</div>
						</li>
							@endforeach
							
						</div>
						</ul>
						
					-->

				</div>

			</div>
			
	
	@endforeach

	</div>
</div>

	
@endsection
