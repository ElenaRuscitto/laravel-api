@extends('layouts.admin')

@include('admin.partials.aside')


@section('content')

    <div class="container my-container">
        <h1 class="mb-5 text-center">{{$title}}</h1>

        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error )
                        <li>{{$error}}</li>
                    @endforeach

                </ul>
            </div>
        @endif


        {{-- messaggio di cancellazione avvenuta del progetto --}}
        @if(session('error'))
            <div class="alert alert-danger" role="alert">
            {{session('error')}}
            </div>
        @endif

        <form action="{{$route}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method($method)
            <div class="mb-3">
                <label for="title" class="form-label">Titolo</label>
                <input
                    type="text"
                    class="form-control @error('title') is-invalid @enderror"
                    id="title"
                    aria-describedby="emailHelp"
                    name="title"
                    value="{{old('title', $project?->title)}}">

                    @error('title')
                        <small class="text-danger">
                            {{$message}}
                        </small>
                    @enderror
            </div>

            <div class="mb-3">

                    <label for="type" class="form-label">Tipo</label>
                    <select
                        name="type_id"
                        class="form-select w-25"
                        aria-label="Default select example">

                    <option value="" >Seleziona un tipo</option>
                        @foreach ($types as $type )
                        <option
                        value="{{$type->id}}"
                        @if(old('type_id', $project?->type_id) == $type->id ) selected  @endif>
                        {{$type->name}}
                        </option>

                        @endforeach
                    </select>
            </div>


            <div class="mb-3">
                <label class="form-label me-3">Tecnologia/e:</label>
                <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                    @foreach ($technologies as $technology)
                    <input
                      type="checkbox"
                      class="btn-check"
                      id="technology_{{$technology->id}}"
                      value="{{$technology->id}}"
                      autocomplete="off"
                      name="technologies[]"

                      @if ($errors->any() && in_array($technology->id, old('technologies',[]))
                      || !$errors->any() && $project?->technologies->contains($technology))
                      checked
                      @endif
                      >

                    <label
                        class="btn btn-outline-success"
                        for="technology_{{$technology->id}}">{{$technology->name}}</label>


                @endforeach
            </div>






            <div class="mb-3">
                <label for="link" class="form-label">Link</label>
                <input
                    type="text"
                    class="form-control @error('link') is-invalid @enderror"
                    id="link"
                    name="link"
                    value="{{old('link', $project?->link)}}">
                    @error('link')
                        <small class="text-danger">
                            {{$message}}
                        </small>
                    @enderror
            </div>


            <div class="mb-3">
                <label for="image" class="form-label">Immagine</label>
                <input
                  type="file"
                  class="form-control"
                  name="image"
                  placeholder="Inserisci immagine"
                  onchange="showImage(event)"
                  value="{{old('image', $project?->image)}}">
                  <img class="thumb w-25 mt-2" id="thumb" src="{{asset('storage/' . $project?->image)}}"
                  onerror="this.src='/img/no-image.png'">
                  {{-- <p>{{$project?->original_image}}</p> --}}
            </div>


            <div class="mb-3">
                <label for="description" class="form-label">Descrizione</label>
                <textarea
                    type="text"
                    class="form-control @error('description')is-invalid @enderror"
                    id="description"
                    aria-describedby="emailHelp"
                    name="description"
                    value="{{old('description', $project?->description)}}">
                </textarea>

            </div>

            <div>
                <button type="submit" class="btn {{Route::currentRouteName() === 'admin.projects.create' ? 'btn-success' : 'btn-success'}}">{{$button}}</button>
                <a class="btn btn-primary" href="{{route('admin.projects.index')}}">Torna ai Progetti</a>


                {{-- <button class="btn btn-primary " type="submit">Aggiungi Progetto</button>
            </div> --}}
        </form>
    </div>




    <script>
        function showImage(event){
            const thumb = document.getElementById('thumb');
            thumb.src = URL.createObjectURL(event.target.files[0]);

        }
    </script>


@endsection
