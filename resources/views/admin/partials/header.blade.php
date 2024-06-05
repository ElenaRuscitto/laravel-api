<nav class="navbar navbar-expand-lg my-navbar fixed-top ">
    <div class="container">
      <a class="navbar-brand my-a" href="#">Navbar Admin</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link my-a" aria-current="page" href="{{route('admin.home')}}">Home Admin</a>
          </li>
          <li class="nav-item">
            <a class="nav-link my-a" href="{{route('home')}}" target="_blank">Vai al Sito</a>
          </li>
          {{-- <li class="nav-item">
            <a class="nav-link" href="{{route('project.projects.index')}}">Vedi i Progetti</a>
          </li> --}}

        </ul>
      </div>
      {{-- dx --}}
      <div class="d-flex">

        <div class="input-group mb-3 me-4 mt-3">

            <form
                action="{{route('admin.projects.index')}}"
                method="GET"
                class="d-flex me-3"
                role="search">
                <input
                    type="search"
                    name="toSearch"
                    class="form-control"
                    placeholder="Cerca Progetto"
                    aria-label="Recipient's username"
                    aria-describedby="button-addon2">

                <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
          </div>

        <p class="pt-4">{{Auth::user()->name}}</p>

        <form
            action="{{ route('logout') }}"
            method="POST">
            @csrf
            <button type="submit" class="btn btn-light ms-3 mt-3" >
                <i class="fa-solid fa-right-from-bracket"></i>
            </button>
        </form>
     </div>
    </div>
  </nav>

