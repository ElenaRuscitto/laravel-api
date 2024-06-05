

  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
      <a class="navbar-brand" href="#">Navbar Pubblico</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{route('admin.home')}}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">-----</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">-----</a>
          </li>
        </ul>
        <span class="navbar-text">
            <a class="nav-link" href="{{route('login')}}">Login</a>
        </span>
        <span class="navbar-text ms-4">
            <a class="nav-link" href="{{route('register')}}">Registrati</a>
           </span>
      </div>
    </div>
  </nav>
