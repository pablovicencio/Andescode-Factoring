<body>
  <nav class="navbar navbar-expand-sm bg-white">
                <img class="img-fluid" src="../recursos/img/logo/logo_fa.png" alt="Viracocha" width="150" height="30">
                <ul class="navbar-nav ml-auto" >
                <li class="nav-item">Bienvenido: <br><i class="fa fa-briefcase" aria-hidden="true"></i>

                  <b><?php echo $_SESSION['nom_fac']; ?></b> </li>
                  <li class="nav-item"><a class="nav-link" href="../controles/logout.php" onclick="return confirm('¿Deseas finalizar sesión?');"><i style="font-size:24px" class="fa">&#xf08b;</i>Cerrar Sesión</a></li>
                </ul>
  </nav>
</body>

