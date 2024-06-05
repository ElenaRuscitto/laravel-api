


@extends('layouts.admin')

@section('content')

<section class="h-100 flex-grow-1 sec-index ">
    <div class="container my-container pt-4 w-100 ">

        <div class="row">
            <div class="col"><h1 class="mb-5 text-center">Dettagli</h1></div>
        </div>

        <div class="row ">

            <div class="col me-5">
                      <h5 class="card-title mb-2 text-capitalize ">Titolo: {{$project->title}}</h5>
                      <p class="card-text">Link: {{$project->link}}</p>
                      <p class="card-text text-capitalize">Tipo: {{$project->type->name}}</p>

                      @if(count($project->technologies) > 0)
                            <p class="card-text">Tecnologia/e: @foreach ($project->technologies as $technology)
                                <span class="badge text-bg-success">{{$technology->name}}</span>
                            @endforeach</p>
                      @endif


                      <p class="card-text">Descrizione: {{$project->description}}</p>

                      <img
                      src="{{asset('storage/' . $project->image)}}"
                      alt="{{$project->title}}"
                      class="img-fluid my-img mt-5"
                      onerror="this.src='/img/no-image.png'">

            </div>

            <div class="d-flex my-3">

                <form
                    action="{{route('admin.projects.destroy', $project)}}"
                    method="post"
                    onsubmit="return confirm('Sei sicuro di voler eliminare . {{$project->name}} . ?')">
                @csrf
                @method('DELETE')
                    <button
                        type="submit"
                        class="btn btn-danger mx-2">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </form>


                <a href="{{route('admin.projects.index')}}" class="btn btn-primary mx-2">Torna ai Progetti</a>

            </div>


        </div>

    </div>
</section>
@endsection
