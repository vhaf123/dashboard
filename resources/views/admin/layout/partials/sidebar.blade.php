<aside class="main-sidebar sidebar-dark-info elevation-4">
  <!-- Brand Logo -->
  <a href="{{route('admin.home')}}" class="brand-link">
    <img src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
         style="opacity: .8">
    <span class="brand-text font-weight-light">AdminLTE 3</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{Auth::guard('admin')->user()->name}}</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2 nav-collapse-hide-child ">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        {{-- tabero --}}
        <li class="nav-item">
          <a href="{{route('admin.home')}}" class="nav-link {{setActive('admin.home')}}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Tablero</p>
          </a>
        </li>


        {{-- Clientes --}}
    
        <li class="nav-item has-treeview {{setOpen('admin.clientes.*')}}">
          <a href="#" class="nav-link {{setActive('admin.clientes.*')}}">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Clientes
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('admin.clientes.index')}}" class="nav-link {{setActive('admin.clientes.index')}}">
                <i class="nav-icon far fa-circle text-info"></i>
                <p>Lista de Clientes</p>
              </a>
            </li>
           
            <li class="nav-item">
              <a href="{{route('admin.clientes.create')}}" class="nav-link {{setActive('admin.clientes.create')}}">
                <i class="nav-icon far fa-circle text-warning"></i>
                <p>Crear Nuevo Cliente</p>
              </a>
            </li>
          </ul>
        </li>


        {{-- Administradores --}}
        <li class="nav-item">
          <a href="#" class="nav-link {{setActive('admin.administradores.*')}}">
            <i class="nav-icon fas fa-users-cog"></i>
            <p>Administradores</p>
          </a>
        </li>


        {{-- Asesores --}}
        <li class="nav-item has-treeview {{setOpen('admin.asesores.*')}}">
          <a href="#" class="nav-link {{setActive('admin.asesores.*')}}">
            <i class="nav-icon fas fa-user-graduate"></i>
            <p>
              Asesores
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('admin.asesores.index')}}" class="nav-link {{setActive('admin.asesores.index')}}">
                <i class="nav-icon far fa-circle text-info"></i>
                <p>Lista de Asesores</p>
              </a>
            </li>
           
            <li class="nav-item">
              <a href="{{route('admin.asesores.create')}}" class="nav-link {{setActive('admin.asesores.create')}}">
                <i class="nav-icon far fa-circle text-warning"></i>
                <p>Crear Nuevo Asesor</p>
              </a>
            </li>

          </ul>
        </li>

        {{-- Boletas --}}
        <li class="nav-item has-treeview {{setOpen('admin.boletas.*')}}">
          <a href="#" class="nav-link {{setActive('admin.boletas.*')}}">
            <i class="nav-icon fas fa-tags"></i>
            <p>
              Boletas
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('admin.boletas.index')}}" class="nav-link {{setActive('admin.boletas.index')}}">
                <i class="nav-icon far fa-circle text-info"></i>
                <p>Lista de Boletas</p>
              </a>
            </li>
           
            <li class="nav-item">
              <a href="{{route('admin.boletas.create')}}" class="nav-link {{setActive('boletas.create')}}">
                <i class="nav-icon far fa-circle text-warning"></i>
                <p>Crear Nueva Boleta</p>
              </a>
            </li>
          </ul>
        </li>

        {{-- Asesorias --}}
        <li class="nav-item has-treeview {{setOpen('admin.asesorias.*')}}">
          <a href="#" class="nav-link {{setActive('admin.asesorias.*')}}">
            <i class="nav-icon fas fa-chalkboard-teacher"></i>
            <p>
              Asesorías
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('admin.asesorias.pendientes')}}" class="nav-link {{setActive('admin.asesorias.pendientes')}}">
                <i class="nav-icon far fa-circle text-info"></i>
                <p>Paquetes Pendientes</p>
              </a>
            </li>
          
            <li class="nav-item">
              <a href="{{route('admin.asesorias.nuevoPaquete')}}" class="nav-link {{setActive('admin.asesorias.nuevoPaquete')}}">
                <i class="nav-icon far fa-circle text-warning"></i>
                <p>Nuevo Paquete</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{route('admin.asesorias.nuevaAsesoria')}}" class="nav-link {{setActive('admin.asesorias.nuevaAsesoria')}}">
                <i class="nav-icon far fa-circle text-secondary"></i>
                <p>Nueva Asesoría </p>
              </a>
            </li>

          </ul>
        </li>



        <li class="nav-header">TAREAS</li>

        {{-- Roles de administrador --}}
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user-lock"></i>
            <p>Roles de Administrador</p>
          </a>
        </li>

        {{-- Materiales --}}
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-box-open"></i>
            <p>
              Materiales
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Boletines Pre</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Solucionarios Pre</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Examenes Pre</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Examenes de Admsiòn</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Libros</p>
              </a>
            </li>
          </ul>
        </li>


      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>