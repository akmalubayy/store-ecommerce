@extends('./layouts/admin')

@section('title')
    Users Admin - StorEcommerce
@endsection

@section('content')
<section
            class="section-content section-dashboard-theme"
            data-aos="fade-up"
          >
            <div class="container-fluid">
              <div class="dashboard-heading">
                <h2 class="dashboard-title">Category Admin (Full Access)</h2>
                <p class="dashboard-subtitle">List Of Users</p>
            </div>
                @if (session('sukses'))
                    <div class="alert alert-primary" role="alert">
                        {{ session('sukses') }}
                    </div>
                @endif

                {{-- @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif --}}

              <div class="dashboard-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <a href="{{ route('user.create') }}" class="btn btn-primary mb-3">
                               <span class="ti ti-plus"></span> Tambah User</a>
                               <div class="table-responsive">
                                   <table class="table table-hover scroll-horizontal-vertical w-100" id="crudTable">
                                       <thead>
                                           <tr>
                                               <th>ID</th>
                                               <th>Name</th>
                                               <th>Email</th>
                                               <th>Roles</th>
                                               <th>Aksi</th>
                                           </tr>
                                       </thead>
                                       <tbody>

                                       </tbody>
                                   </table>
                               </div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </section>
@endsection

@push('addon-script')
    <script>
        var dataTables = $('#crudTable').DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: {
            url: '{!! url()->current() !!}',
            },
            columns: [
                { data: 'id', name : 'id' },
                { data: 'name', name : 'name' },
                { data: 'email', name : 'email' },
                { data: 'roles', name : 'roles' },
                {
                data: 'action',
                name: 'action',
                orderable: false,
                searcable: false,
                width: '15%',
                },
            ]
        })
    </script>
@endpush
