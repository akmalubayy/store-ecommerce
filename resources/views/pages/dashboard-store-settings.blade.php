@extends('./layouts/dashboard')

@section('title')
    Store Settings - StorEcommerce
@endsection

@section('content')
  <!-- Content Section -->
          <section
            class="section-content section-dashboard-theme"
            data-aos="fade-down"
          >
            <div class="container-fluid">
              <div class="dashboard-heading">
                <h2 class="dashboard-title">Store Settings</h2>
                <p class="dashboard-subtitle">Make store that profitable</p>
              </div>
              <div class="dashboard-content">
                <div class="row mt-3">
                  <div class="col-12">
                    <form action="{{ route('dashboard-settings-redirect', 'dashboard-store-settings') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                      <div class="card">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="storeName">Store Name</label>
                                <input
                                  type="text"
                                  name="store_name"
                                  id="storeName"
                                  class="form-control"
                                  value="{{ $user->store_name }}"
                                />
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                    <label for="category">Category</label>
                                    <select name="categories_id" id="categories" class="form-control">
                                                <option value="{{ $user->$categories_id }}" disabled selected>Tidak Diganti</option>
                                                @forelse ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @empty
                                                    <option value="" selected disabled>-- Tidak ada category --</option>
                                                @endforelse
                                            </select>
                              </div>
                            </div>
                            <div class="col-md-6 mt-3">
                              <div class="form-group">
                                <label for="store">Store Status</label>
                                <p class="text-muted">
                                  Apakah saat ini toko Anda buka?
                                </p>
                                <div
                                  class="
                                    custom-control
                                    custom-radio
                                    custom-control-inline
                                  "
                                >
                                  <input
                                    type="radio"
                                    name="store_status"
                                    id="openStoreTrue"
                                    class="custom-control-input"
                                    value="1"
                                    {{ $user->store_status == 1 ? 'checked' : '' }}
                                  />
                                  <label
                                    for="openStoreTrue"
                                    class="custom-control-label"
                                  >
                                    Buka
                                  </label>
                                </div>
                                <div
                                  class="
                                    custom-control
                                    custom-radio
                                    custom-control-inline
                                  "
                                >
                                  <input
                                    type="radio"
                                    name="store_status"
                                    id="openStoreFalse"
                                    class="custom-control-input"
                                    value="0"
                                    {{ $user->store_status == 0 || $user->store_status == NULL ? 'checked' : '' }}
                                  />
                                  <label
                                    for="openStoreFalse"
                                    class="custom-control-label"
                                  >
                                    Sementara Tutup
                                  </label>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col text-right">
                              <button
                                type="submit"
                                class="btn btn-success px-5"
                              >
                                Save Now
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </section>
@endsection

@push('addon-script')
     <!-- Script Jquery -->
    <script>
      $('#menu-toggle').click(function (event) {
        event.preventDefault();
        $('#wrapper').toggleClass('toggled');
      });
    </script>
@endpush
