<nav class="navbar navbar-expand-lg navbar-dark fs-5" style="background-color:#7E57C2;">
  <div class="container-fluid">
    <a class="navbar-brand text-white fs-3" href="{{ route('home') }}">{{ settings()->title }}</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <!--<li class="nav-item">
          <a class="nav-link" id="ranking-link" href="#">Ranking</a>
        </li>-->
        <li class="nav-item">
          <a class="nav-link" id="blog-link" href="{{ route('posts') }}">Blog</a>
        </li>
      </ul>
      <!--@guest
        <div class="d-flex">
          <a class="nav-link" href="{{ route('login') }}">
            <button class="btn btn-outline-light fs-5">
              Logowanie
            </button>
          </a>
          <a class="nav-link" href="{{ route('register') }}">
            <button class="btn btn-outline-light fs-5">
              Rejestracja
            </button>
          </a>
        </div>
      @endguest-->
      @auth
        <div class="d-flex">
          <span class="navbar-text d-flex align-items-center text-white">Witaj,&nbsp;<span class="d-flex align-items-center text-decoration-underline">{{ Auth::user()->name }}</span></span>
          <a class="nav-link" href="{{ route('logout') }}">
            <button class="btn btn-outline-light fs-5">
              Wyloguj
            </button>
          </a>
        </div>
        @if (Auth::user()->isAdmin())
        <div class="dropdown">
          <a class="btn btn-outline-warning fs-5 dropdown-toggle" href="{{ route('admin.home') }}" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
            Panel administracyjny
          </a>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <li><a class="dropdown-item" href="{{ route('admin.hostings') }}">Hostingi</a></li>
            <li><a class="dropdown-item" href="{{ route('admin.posts') }}">Posty</a></li>
            <li><a class="dropdown-item" href="{{ route('admin.settings') }}">Ustawienia</a></li>
          </ul>
        </div>
        @endif
      @endauth
    </div>
  </div>
</nav>
<script>
    var ranking = document.getElementById('ranking-link');
    var blog = document.getElementById('blog-link');
    
    function resetClasslist() {
      ranking.classList.remove('active');
      blog.classList.remove('active');
    }
    
    ranking.addEventListener('click', (e) => {
      e.preventDefault();
      resetClasslist();
      ranking.classList.add('active');
    })

    blog.addEventListener('click', (e) => {
      e.preventDefault();
      resetClasslist();
      blog.classList.add('active');
    })
</script>
