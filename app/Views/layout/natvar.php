<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="nav nav-pills nav-fill">
        <li class="nav-item">
          <a class="nav-link active" id="registros" aria-current="page" href="registros">Generar registros</a>
        </li>
        <?php if($this->session->get('perfil') == 1):?>
          <li class="nav-item">
            <a class="nav-link"  id="listarRegistros" href="listarRegistros">Consultar registros</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="listarUsuarios" href="listarUsuarios">Usuarios</a>
          </li>
        <?php endif;?>
      </ul>
    </div>
  </div>
</nav>
<script>
  $('.nav-link').removeClass("active");
  var pathname = window.location.pathname;
  var res=pathname.split('/');
  $('#'+res[2]).addClass("active")
</script>