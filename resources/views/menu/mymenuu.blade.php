@php
  use TCG\Voyager\Facades\Voyager;
@endphp

<ul class="nav justify-content-center nav-underline">
  <li class="nav-item logo d-flex align-items-center">
    <?php $admin_logo_img = Voyager::setting('admin.icon_image', ''); ?>
    <img style="width: 40px; height: 40px; margin-right: 10px;" src="{{ Voyager::image($admin_logo_img) }}"
      alt="Logo Icon">
    <h3 style="margin: 0; color: black;">EcoLoop</h3>
  </li>

  @php
  if (Voyager::translatable($items)) {
    $items = $items->load('translations');
  }
  @endphp

  @foreach ($items as $item)
    @php
    $originalItem = $item;
    if (Voyager::translatable($item)) {
    $item = $item->translate($options->locale);
    }
  @endphp
    <li class="nav-item">
    <a class="nav-link" href="{{ url($item->link()) }}" target="{{ $item->target }}">
      {{ $item->title }}
    </a>
    @if(!$originalItem->children->isEmpty())
    @include('voyager::menu.default', ['items' => $originalItem->children, 'options' => $options])
  @endif
    </li>
  @endforeach

  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"><img
        src="{{ Voyager::image(Auth::user()->avatar) }}" class="dropdown-avatar"
        alt="{{ Auth::user()->name }} avatar"></a>
    <ul class="dropdown-menu">
      <li class="dropdown-item profile">
        <img src="{{ Voyager::image(Auth::user()->avatar) }}" class="avatar" alt="{{ Auth::user()->name }} avatar">
        <div class="profile-body">
          <h6><strong>Hola, {{ Auth::user()->name }}</strong></h6>
          <h6>{{ Auth::user()->email }}</h6>
        </div>
      </li>
      <li>
        <hr class="dropdown-divider">
      </li>
      <li><a class="dropdown-item" href="{{ route('usuarios.show', Auth::user()->id) }}">Mi Perfil</a></li>
      <li><a href="{{ route('intereses') }}" class="dropdown-item">Mis Intereses</a></li>
      <li><a class="dropdown-item p-0" href="#">
          <form action="{{ route('logout') }}" method="POST">
            {{ csrf_field() }}
            <button type="submit" class="btn btn-danger custom-button">Cerrar sesión</button>
          </form>
        </a></li>
    </ul>

  </li>
</ul>

<style>

    .dropdown-item{
      margin-top: 5px;
      border-radius: 0.375rem;
    }

  .dropdown-item:hover,
  .dropdown-item:active {
    background-color: #698D43;
    color: white;
  }


  /* .nav-link .dropdown-toggle a{
    padding-bottom: 1px;
  } */
  .nav-underline .nav-link {
    color: black;
  }

  .nav-underline .nav-link:hover,
  .nav-underline .nav-link:focus,
  .nav-underline .nav-link:active {
    color: #698D43;
  }


  .nav {
    padding-top: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
    /* box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); */
    /* box-shadow: 1px -2px 26px 2px rgba(0,0,0,0.65); */
    /* box-shadow: 1px -7px 26px 2px rgba(0,0,0,0.65); */
    box-shadow: 1px -7px 26px 2px rgba(0, 0, 0, 0.55);

    /* background-color: #4CA76F; */
    background-color: white;

    /* background-color: #191919; */

    z-index: 1000;

  }

  .nav-item a {
    /* font-weight: bold; */
    font-size: 18px;
  }

  .nav-item.logo {
    position: absolute;
    left: 10px;
    top: 50%;
    transform: translateY(-50%);
    display: flex;
    align-items: center;
    /* Alinea los hijos verticalmente */
  }

  .nav-item.dropdown {
    position: absolute;
    right: 10px;
    /*    top: 50%; */
    /*    transform: translateY(-50%); */
    display: flex;
    align-items: center;
    /* Alinea los hijos verticalmente */
  }

  .dropdown-avatar {
    border-radius: 50%;
    /* height: 30px; */
    margin-right: 5px;
    /* width: 30px */

    object-fit: cover;
    height: 25px;
  }

  .dropdown-menu{
    padding-left: 8px;
    padding-right: 8px;
  }
  .dropdown-menu a {
    font-size: 17px;
  }

  .custom-button {
    width: 210px;
  
  }

  .dropdown-item.profile img {
    border-radius: 50%;
    float: left;
    height: 60px;
    margin-right: 10px;
    width: 60px;
  }

  .profile-body {
    padding-top: 10px;
  }

  .profile-body h6 {
    font-weight: normal;
    font-size: 13px;
  }

  .nav-item.logo img {
    margin-right: 10px;
  }

  .nav-item.logo h3 {
    margin: 0;
    color: #FFFFFF;
    font-size: 1.25rem;
  }
</style>