@include('backend.layouts.header')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

  @yield('content')
  </div>
  <!-- /.content-wrapper -->
@include('backend.layouts.footer')

  @yield('ajax')
