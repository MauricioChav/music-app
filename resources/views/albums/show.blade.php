@extends('layouts.master')

@section('content')

<div class="container pt-5">
<div class="container-fluid">
    <div class="px-4 mb-5">
      
      <div class="row">
      <div class="col-lg-4">
      	<div class="row">
      		<div class="col-lg-6">
      			<img alt="{{ $album->name }}_cover" src="{{ asset('storage/album_covers/') }}/{{$album->cover}}" width="100%">
      			<button type="button" class="btn btn-primary mt-4" data-bs-toggle="modal" data-bs-target="#songCreate">Crear Nueva Canción</button>
      			<a class="btn btn-info mt-3" href="{{ route('albums.edit', $album->id) }}">Editar álbum</a>
      			<button type="button" class="btn btn-sm btn-danger mt-3" data-bs-toggle="modal" data-bs-target="#albumDelete">Borrar Álbum</button>
      		</div>
      		<div class="col-lg-6">
      			<h1 class="display-4 fw-bold green-title">{{$album->name}}</h1>
        		<p class="lead mb-4">{{ $album->artist }}</p>
        		<p class="lead mb-4">{{ $album->year }}</p>
				<p class="lead mb-4">Canciones: {{ count( $album->songs ) }}</p>

      		</div>
      	</div>  

      </div>    	
			

		<div class="col-lg-8 songsAl">
      	
      	<table class="table">
				<thead>
					<tr>
						<th scope="col">Nombre</th>
						<th scope="col">Reproductor</th>
						<th scope="col">Track</th>
						<th scope="col">Acciones</th>
					</tr>
				</thead>
				
				<tbody>

		@foreach($album->songs as $song)

		
			<tr>
				<td><p>{{ $song->name }}</p></td>
				<td>
					<script type="text/javascript">

						var songfile{{ $song->id }} = decodeEntities( "{{ $song->music_file }}" );


						    $(document).ready(function(){
						      $("#jquery_jplayer_{{ $song->id }}").jPlayer({
						        ready: function () {
						          $(this).jPlayer("setMedia", {
						            title: "{{ $song->name }}",
						            m4a: "{{ asset('storage/music_files/') }}/" + songfile{{ $song->id }},
						            poster: "{{ asset('css/img/LogoText.png') }}"
						          });
						        },
						        cssSelectorAncestor: "#jp_container_{{ $song->id }}",
						        swfPath: "/js",
						        supplied: "m4a, oga",
						        useStateClassSkin: true,
						        autoBlur: false,
						        smoothPlayBar: true,
						        keyEnabled: true,
						        remainingDuration: true,
						        toggleDuration: true
						      });
						    });
						  </script>

					<div id="jquery_jplayer_{{ $song->id }}" class="jp-jplayer"></div>
					<div id="jp_container_{{ $song->id }}" class="jp-audio" role="application" aria-label="media player" style="width: 100%">
						<div class="jp-type-single">
							<div class="jp-gui jp-interface">
								<div class="jp-controls">
									<button class="jp-play" role="button" tabindex="0">play</button>
									<button class="jp-stop" role="button" tabindex="0">stop</button>
								</div>
								<div class="jp-progress">
									<div class="jp-seek-bar">
										<div class="jp-play-bar"></div>
									</div>
								</div>
								<div class="jp-volume-controls">
									<button class="jp-mute" role="button" tabindex="0">mute</button>
									<button class="jp-volume-max" role="button" tabindex="0">max volume</button>
									<div class="jp-volume-bar">
										<div class="jp-volume-bar-value"></div>
									</div>
								</div>
								<div class="jp-time-holder">
									<div class="jp-current-time" role="timer" aria-label="time">&nbsp;</div>
									<div class="jp-duration" role="timer" aria-label="duration">&nbsp;</div>
									<div class="jp-toggles">
										<button class="jp-repeat" role="button" tabindex="0">repeat</button>
									</div>
								</div>
							</div>
							<div class="jp-details">
								<div class="jp-title" aria-label="title">&nbsp;</div>
							</div>
							<div class="jp-no-solution">
								<span>Update Required</span>
								To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
							</div>
						</div>
					</div>

				</td>

				<td><p>{{ $song->track }}</p></td>
				<td>
					<a class="btn btn-sm btn-info" href="{{ route('songs.edit', $song->id) }}"><ion-icon name="create-outline"></ion-icon></a>

					<button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#songDelete_{{ $song->id }}"><ion-icon name="trash-outline"></ion-icon></button>
				</td>
			</tr>

			<div class="modal fade" id="songDelete_{{ $song->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog">
									<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title green-title-sm">Estatus</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
					  
								<form method="POST" action="{{ route('songs.destroy', $song->id) }}">

									<div class="row">
			      						<div class="modal-r-body col-8" style="margin: auto;">

											{{ csrf_field() }}	
											{{ method_field('DELETE') }}

											<input type="hidden" name="origin" value=1>

											<h4>¿Quieres borrar la canción "<strong>{{ $song->name }}</strong>" de la aplicación de forma definitiva?
											</h4>
											<h5 style="color: red;"> Esta acción no se puede deshacer</h5>

										</div>

										<div class="modal-footer col-8" style="margin: auto;">
												<button type="submit" class="btn btn-danger">Sí</button>
												<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
										</div>
									</div>
								
								</form>
					  
					</div>
				  </div>
				</div>


		@endforeach
		</tbody>
		</table>

		@if(count( $album->songs ) == 0)

		<h2 style="text-align: center;">Este álbum esta vacío. Crea una nueva canción desde el cuadro inferior</h2>

		@endif
        
      </div>


      </div>
      <div class="overflow-hidden" style="max-height: 30vh;">
        <div class="container px-5">
          
        </div>
      </div>
    </div>
</div>
</div>

<!-- Modal Crear cancion -->
<div class="modal fade" id="songCreate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title green-title-sm" id="exampleModalLabel">Crear Nueva Canción</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
	  
	  <form method="POST" action="{{ route('songs.store') }}" enctype="multipart/form-data">
					<!--Campo de protección de Formulario-->
					{{ csrf_field() }}
					
					<input class="form-control" type="hidden" name="album_id" value="{{ $album->id }}">


					<div class="form-group row">
							<div class="col-9" style="margin: auto;">
	                            
								<label class="mt-3">Nombre de la canción</label>

								<input required maxlength="35" class="form-control" type="text" name="name" placeholder="Nombre de la canción">
								
						</div>
					</div>
									
					<div class="form-group row">
							<div class="col-9" style="margin: auto;">
	                            
								<label class="mt-3">Track</label>

								<input required maxlength="3" class="form-control" type="number" name="track" placeholder="No.">
								
						</div>
					</div>

					<div class="form-group row">
							<div class="col-9" style="margin: auto;">
	                            
								<label class="mt-3">Archivo</label>

								<input required class="form-control" type="file" name="music_file" accept="audio/*">
								
						</div>
					</div>

					
					
					<div class="form-group row mb-0 pt-3 pb-3">
                            <div class="col-9" style="margin: auto;">
					<button class="btn btn-primary mt-3" type="submit">Guardar Canción</button>
				</div>
			</div>

				</form>
	  
    </div>
  </div>
</div>

<!-- Modal Borrar álbum -->
				<div class="modal fade" id="albumDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog">
									<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title green-title-sm">Estatus</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
					  
								<form method="POST" action="{{ route('albums.destroy', $album->id) }}">

									<div class="row">
			      						<div class="modal-r-body col-8" style="margin: auto;">

											{{ csrf_field() }}	
											{{ method_field('DELETE') }}

											<h4>¿Quieres borrar el álbum "<strong>{{ $album->name }}</strong>" de la aplicación de forma definitiva? 
											</h4>
											<h4> Esto borrará todas las canciones asociadas</h4>
											<h5 style="color: red;"> Esta acción no se puede deshacer</h5>

										</div>

										<div class="modal-footer col-8" style="margin: auto;">
												<button type="submit" class="btn btn-danger">Sí</button>
												<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
										</div>
									</div>
								
								</form>
					  
					</div>
				  </div>
				</div>



<div class="container my-4">

	<div class=" align-items-center">
		<div class="pb-4" style="text-align: right;">
		
		<a href="{{ route('songs.index') }}" class="btn btn-secondary btn-lg px-4 me-sm-3">Ir a canciones</a>
		<a href="{{ route('albums.index') }}" class="btn btn-secondary btn-lg px-4 me-sm-3">Regresar a álbums</a>
		
		</div>

	
	</div>
</div>

@endsection