@extends('layouts.admin')


@section('content')

    <div class="container my-container">

                <h1 class="text-center ">Elenco per Tecnologie</h1>


                <table class="table mt-5">

                        <thead>
                        <tr>
                            <th scope="col">Tecnologia</th>
                            <th scope="col">Titolo</th>
                        </tr>
                        </thead>
                        <tbody>

                                <tr>

                                        <th class=" "><span class="badge text-bg-success">{{$technology->name}}</span>  </th>

                                        <td class=" align-content-center">
                                            {{-- @dump($projects) --}}
                                            <ul class="list-group">
                                                {{-- @dd($technology) --}}
                                                @foreach ($technology->projects as $project)
                                                    <li class="list-group-item">
                                                        <a href="{{route('admin.projects.show', $project)}}">
                                                            {{$project->id}} - {{$project->title}}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>

                                        </td>


                                </tr>


                        </tbody>


                </table>



    </div>






    <script>
        function submitForm(id){
            const form = document.getElementById(`form-edit-${id}`);
            console.log(form);
            form.submit();
        }
    </script>

@endsection
