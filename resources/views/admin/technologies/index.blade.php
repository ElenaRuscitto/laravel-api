@extends('layouts.admin')

@section('content')


<div class="container my-container">
    <div class="col-12">
        @if (session('successo'))
            <div class="alert alert-success h-25" role="alert">
                <p>{{ session('successo') }}</p>
            </div>
        @endif

        @if (session('errore'))
            <div class="alert alert-danger" role="alert">
            <p>{{ session('errore') }}</p>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            </div>
        @endif
    </div>
    <div class="row row-cols-2 ">





        {{-- colonna Technology--}}
        <div class="col">


            <div class="px-2 my-card rounded-3 pb-1">

                <h2 class="py-3 text-white rounded-3 fw-bold fs-2 p-3 mt-3">Lista Tecnologie</h2>
                <table class="table rounded-3">
                    <thead>
                    <tr>
                        <th class="">Id</th>
                        <th class="">Nome</th>
                        <th class="ps-4" scope="col">Azioni</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($tecnologies as $technology)

                        <tr>
                            <form
                                action="{{ route('admin.technologies.update', $technology) }}"
                                method="POST"
                                id="edit-tech-{{ $technology->id }}">
                                @csrf
                                @method('PUT')
                                    <th>{{$technology->id}}</th>
                                    <td>
                                        <input
                                        class=""
                                        type="text"
                                        name="name"
                                        value="{{ $technology->name }}">

                                    </td>
                                    <td>
                                        <button
                                            type="submit"
                                            class="btn btn-warning"
                                            onclick="submitForm({{$technology->id }})">
                                                <i class="fa-solid fa-pen"></i>
                                        </button>

                            </form>


                                        <form
                                            action="{{ route('admin.technologies.destroy', $technology) }}"
                                            method="POST"
                                            onsubmit="return confirm('Sei sicuro di voler eliminare {{ $technology->name }}?')"
                                            class="d-inline-block">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>


            {{-- aggiungi nuova Tecnologia --}}

            <div class="px-2 mt-5 rounded-3 pb-1">

                <h2 class="py-3  text-myColor rounded-3 fw-bold fs-2 p-3 mt-3">Aggiungi una nuova Tecnologia</h2>
                <form action="{{ route('admin.technologies.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                      <label for="name" class="form-label">Inserisci un nome*</label>
                      <input type="text" id="title" name="name" class="form-control bg-secondary-subtle"
                        value="{{ old('name') }}">
                    </div>

                    <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i></button>
                  </form>

            </div>

        </div>


        {{-- colonna Type--}}
        <div class="col">


            <div class="px-2 my-card rounded-3 pb-1">

                <h2 class="py-3 text-white  rounded-3 fw-bold fs-2 p-3 mt-3">Lista Tipi</h2>
                <table class="table rounded-3">
                    <thead>
                    <tr>
                        <th class="">Id</th>
                        <th class="">Nome</th>
                        <th class="ps-4" scope="col">Azioni</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($types as $type)

                        <tr>
                            <form
                                action="{{ route('admin.types.update', $type) }}"
                                method="POST"
                                id="edit-tech-{{ $type->id }}">
                                @csrf
                                @method('PUT')
                                    <th>{{$type->id}}</th>
                                    <td>
                                        <input
                                        class=""
                                        type="text"
                                        name="name"
                                        value="{{ $type->name }}">

                                    </td>
                                    <td>
                                        <button
                                            type="submit"
                                            class="btn btn-warning"
                                            onclick="submitForm({{$type->id }})">
                                                <i class="fa-solid fa-pen"></i>
                                        </button>

                            </form>





                                        <form
                                            action="{{ route('admin.types.destroy', $type) }}"
                                            method="POST"
                                            onsubmit="return confirm('Sei sicuro di voler eliminare {{ $type->name }}?')"
                                            class="d-inline-block">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>


            {{-- aggiungi nuovo Tipo --}}

            <div class="px-2 mt-5 rounded-3 pb-1">

                <h2 class="py-3  text-myColor rounded-3 fw-bold fs-2 p-3 mt-3">Aggiungi un nuovo Tipo</h2>
                <form action="{{ route('admin.types.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                      <label for="name" class="form-label">Inserisci un nome*</label>
                      <input type="text" id="title" name="name" class="form-control bg-secondary-subtle"
                        value="{{ old('name') }}">
                    </div>

                    <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i></button>
                  </form>

            </div>
        </div>
    </div>
</div>



<script>
    function submitForm(id){
        const form = document.getElementById(`form-edit-${id}`);
        console.log(form);
        form.submit();
    }
</script>

@endsection
