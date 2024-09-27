<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
     
      <li class="nav-item">
        <a href="{{route('admin.dashboard')}}" class="nav-link {{ (request()->is('admin/dashboard*')) ? 'active' : '' }}">
          <i class="nav-icon fas fa-th"></i>
          <p>
            Dashboard
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{route('allcustomer')}}" class="nav-link {{ (request()->is('admin/customer*')) ? 'active' : '' }}">
          <i class="nav-icon fas fa-user"></i>
          <p>
            Customer
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{route('allcar')}}" class="nav-link {{ (request()->is('admin/car*')) ? 'active' : '' }}">
          <i class="nav-icon fas fa-car"></i>
          <p>
            Car
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{route('allrental')}}" class="nav-link {{ (request()->is('admin/rentals*')) ? 'active' : '' }}">
          <i class="nav-icon fas fa-key"></i>
          <p>
            Rentals
          </p>
        </a>
      </li>

    </ul>
  </nav>