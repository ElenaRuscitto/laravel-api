@extends('layouts.admin')


@section('content')

    <div class="container my-container">

                <h1 class="text-center ">Elenco per Tipo</h1>


                <table class="table mt-5">

                        <thead>
                        <tr>
                            <th scope="col">TIPO:</th>
                            <th scope="col">PROGETTO:</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($types as $type )
                                <tr>

                                        <th class=" align-content-center"> {{$type->name}} </th>

                                        <td class=" align-content-center ">
                                            <ul class="my-ul">
                                                @foreach ($type->projects as $project)
                                                    <li class="my-li"> <a href="{{route('admin.projects.show', $project)}}">{{$project->title}} {{$project->id}}</a></li>
                                                @endforeach
                                            </ul>

                                        </td>


                                </tr>


                            @endforeach

                        </tbody>


                </table>

            <div class="paginator">
                {{$types->links()}}
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
