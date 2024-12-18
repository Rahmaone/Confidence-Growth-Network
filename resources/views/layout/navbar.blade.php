<nav class="navbar navbar-expand-lg custom_nav-container hunter-green-bg">
    <a class="navbar-brand" href="index.html">
      <span class="font-italic">CGN</span>
    </a>

    <button
      class="navbar-toggler"
      type="button"
      data-toggle="collapse"
      data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class=""> </span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="{{route('home')}}"
            >Home</a
          >
        </li>
        <li class="nav-item">
          <div class="dropdown">
            <a
              class="nav-link dropdown-toggle"
              href="#"
              role="button"
              id="serviceDropdown"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              Services
            </a>
            <div class="dropdown-menu" aria-labelledby="serviceDropdown">
              <a class="dropdown-item" href="#">Modul Pembelajaran</a>
              <a class="dropdown-item" href="{{ route('user.chatmentor') }}">Chat Mentor CGN</a>
              <a class="dropdown-item" href="#">Kuis</a>
              <a class="dropdown-item" href="#">Event</a>
            </div>
          </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="#about">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#team">Team</a>
        </li>
        @auth
        <li class="nav-item">
          <div class="dropdown">
            <a
              class="nav-link dropdown-toggle"
              href="#"
              role="button"
              id="profileDropdown"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              <i class="fa fa-user" aria-hidden="true"></i>{{ Auth::user()->name }}
            </a>
            <div class="dropdown-menu" aria-labelledby="profileDropdown">
              <form action="{{ route('logout') }}" method="POST">
                @csrf
                @method('POST') <!-- CSRF token and POST method -->
                <button type="submit" class="dropdown-item btn">Logout</button>
            </form>
          </div>
        </li>
        @endauth
        @guest
          <li class="nav-item">
            <a class="nav-link" href="{{route('login')}}">
              <i class="fa fa-user" aria-hidden="true"></i> Login</a
            >
          </li>
        @endguest
        <form class="form-inline">
          <button class="btn my-2 my-sm-0 nav_search-btn" type="submit">
            <i class="fa fa-search" aria-hidden="true"></i>
          </button>
        </form>
      </ul>
    </div>
  </nav>
