<nav class="navbar navbar-expand-lg navbar-light shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="/"><span class="text-primary">YouHeal </span>-Hospital</a>

    <div class="collapse navbar-collapse" id="navbarSupport">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/about">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/doctor">Doctors</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="blog.html">News</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact.html">Contact</a>
        </li>

        @auth
          <!-- If user is authenticated -->
          <li class="nav-item">
            <a class="btn btn-primary ml-lg-3" href="{{ route('dashboard') }}">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-danger ml-lg-3" href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
               Logout
            </a>
          </li>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
        @else
          <!-- If user is not authenticated -->
          <li class="nav-item">
            <a class="btn btn-primary ml-lg-3" href="{{ route('login') }}">Login</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-primary ml-lg-3" href="{{ route('register') }}">Register</a>
          </li>
        @endauth
      </ul>
    </div> <!-- .navbar-collapse -->
  </div> <!-- .container -->
</nav>
