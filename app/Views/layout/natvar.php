<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="registros">
      <img src="<?=base_url();?>/public/logo.png" alt="" width="30" height="24" class="d-inline-block align-text-top" style="width: 100px">
    </a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="nav nav-pills nav-fill">
        <li class="nav-item">
          <a class="nav-link" id="registros" aria-current="page" href="registros">Generar registros</a>
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
      <div style="position:relative;left:50%;">
          <button class="btn btn-outline-primary" onclick="salirCession()">
            <i class="fa-solid fa-arrow-right-from-bracket"></i> Cerrar sesión
          </button>
      </div>
    </div>
  </div>
</nav>
<script>
  $('.nav-link').removeClass("active");
  var pathname = window.location.pathname;
  var res=pathname.split('/');
  $('#'+res[2]).addClass("active");

  function salirCession(){
    Swal.fire({
      title: 'Desea cerrar sesion?',
      showDenyButton: true,
      confirmButtonText: 'continuar',
      denyButtonText: `salir`,
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (!result.isConfirmed) {
        $.ajax({
            type: "GET",
            url: "usuarios/Cerrarsesion",
            dataType: "JSON",
            success: function (response) {
                if(response['status']){
                  location.reload();
                }
                else{
                    swal.fire(response['msj']);
                }
            }
        })
      }
      else{

      }
    });
  }
</script>