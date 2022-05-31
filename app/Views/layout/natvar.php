<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="registros">Generar registros</a>
        </li>
        <?php if($this->session->get('perfil') == 1):?>
        <li class="nav-item">
          <a class="nav-link" href="listarRegistros">Consultar registros</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="listarUsuarios">Usuarios</a>
        </li>
        <?php endif;?>
      </ul>
    </div>
  </div>
</nav>