{{-- <!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

	<a href="{{route('home')}}" class="logo">
		<span class="logo-lg">{{ Session::get('business.name') }}</span>
	</a>

    <!-- Sidebar Menu -->
    {!! Menu::render('admin-sidebar-menu', 'adminltecustom'); !!}

    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>
 --}}


 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-light-primary elevation-4">
  <!-- Brand Logo -->
  {{-- <a href="{{ route('home') }}" class="brand-link">
    <img src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">NEW</span>
</a> --}}

<!-- Sidebar user panel (optional) -->



  <!-- Sidebar -->
  <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ auth()->user()->profile_photo ? asset(auth()->user()->profile_photo) : asset('assets/img/AdminLTELogo.png') }}" class="img-circle elevation-2" alt="User Image">
     </div>
     
      <div class="info">
          <a href="{{route('home')}}" class="d-block">{{ Session::get('business.name') }}</a>
      </div>
  </div>


    <!-- SidebarSearch Form -->


    <!-- Sidebar Menu -->
    {!! Menu::render('admin-sidebar-menu', 'adminltecustom'); !!}

    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
