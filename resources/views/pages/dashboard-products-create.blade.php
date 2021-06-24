@extends('./layouts/dashboard')

@section('title')
    Create Product - StorEcommerce
@endsection

@section('content')
  <!-- Content Section -->
          <section
            class="section-content section-dashboard-theme"
            data-aos="fade-down"
          >
            <div class="container-fluid">
              <div class="dashboard-heading">
                <h2 class="dashboard-title">Create New Product</h2>
                <p class="dashboard-subtitle">Create your own product</p>
              </div>
              <div class="dashboard-content">
                <div class="row mt-3">
                  <div class="col-12">
                      @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    <form action="{{ route('dashboard-product-store') }}" method="POST" enctype="multipart/form-data">
                      @csrf

                        <input type="hidden" name="users_id" value="{{ Auth::user()->id }}">
                        <div class="card">
                        <div class="card-body">
                          <div class="row mb-2">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="productName">Product Name</label>
                                <input
                                  type="text"
                                  class="form-control"
                                  id="productName"
                                  name="name"
                                  placeholder="Masukan nama produk"
                                />
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="price">Price</label>
                                <input
                                  type="number"
                                  class="form-control"
                                  id="price"
                                  name="price"
                                  placeholder="Masukan Harga"
                                />
                              </div>
                            </div>
                            <div class="col-12">
                              <div class="form-group">
                                <label for="category">Category</label>
                                <select
                                  name="categories_id"
                                  class="form-control"
                                  id="category"
                                >
                                <option value="" selected disabled>-- Pilih Category --</option>
                                @forelse ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @empty
                                    <option value="" selected disabled>-- Tidak Ada Data Category --</option>
                                @endforelse
                                </select>
                              </div>
                            </div>
                            <div class="col-12">
                              <div class="form-group">
                                <label for="description">Description</label>
                                <textarea id="descriptionEditor" name="description"></textarea>
                              </div>
                            </div>

                            <div class="col-12">
                              <div class="form-group">
                                <label for="thumbnails">Thumbnails</label>
                                <input
                                  type="file"
                                  name="photo_url"
                                  id="thumbnails"
                                  class="form-control"
                                />
                                <p class="text-muted">
                                  Kamu dapat memilih lebih dari satu file
                                </p>
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
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
    <script>
      CKEDITOR.replace('descriptionEditor');
    </script>
@endpush
