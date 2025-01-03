  <nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="/"><span class="text-primary">YouHeal </span>-Hospital</a>

      <form class="d-flex" action="{{ route('logout') }}" method="POST">
        @csrf

        <button class="btn btn-danger ml-lg-3" type="submit">LogOut</button>
      </form>


    </div>
  </nav>