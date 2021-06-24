@extends('./layouts/admin')

@section('title')
    Transaction Admin Area - StorEcommerce
@endsection

@section('content')
<section
            class="section-content section-dashboard-theme"
            data-aos="fade-up"
          >
            <div class="container-fluid">
              <div class="dashboard-heading">
                <h2 class="dashboard-title">Product Admin (Full Access)</h2>
                <p class="dashboard-subtitle">List Of Transactions</p>
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
                               <div class="table-responsive">
                                   <table class="table table-hover scroll-horizontal-vertical w-100" id="crudTable">
                                       <thead>
                                           <tr>
                                               <th>ID</th>
                                               <th>Name</th>
                                               <th>Harga</th>
                                               <th>Status</th>
                                               <th>Tanggal</th>
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
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/plug-ins/1.10.20/sorting/datetime-moment.js"></script>
<!-- Moment.js: -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

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
                { data: 'user.name', name : 'user.name' },
                { data: 'total_price', name : 'total_price' },
                { data: 'transaction_status', name : 'transaction_status' },
                {
                    data: 'created_at',
                    type: 'num',
                    render: {
                                _: 'display',
                                sort: 'timestamp'
                            },
                },
                {
                data: 'action',
                name: 'action',
                orderable: false,
                searcable: false,
                width: '15%',
                },
            ],
            columnDefs: [
          {
              targets: [2],
              render: $.fn.dataTable.render.number( ',', '.', 2, 'Rp. ' )
          },
        ],
        });
    </script>
@endpush
