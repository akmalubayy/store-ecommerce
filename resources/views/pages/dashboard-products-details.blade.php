@extends('./layouts/dashboard')

@section('title')
    My Products - StorEcommerce
@endsection

@section('content')
 <!-- Content Section -->
          <section
            class="section-content section-dashboard-theme"
            data-aos="fade-down"
          >
            <div class="container-fluid">
              <div class="dashboard-heading">
                <h2 class="dashboard-title">Shirup Marzan</h2>
                <p class="dashboard-subtitle">Product Details</p>
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
                    <form action="{{ route('dashboard-product-update', $product->id) }}" method="POST" enctype="multipart/form-data">
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
                                  value="{{ $product->name }}"
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
                                  value="{{ $product->price }}"
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
                                <option value="{{ $product->categories_id }}" selected disabled>{{ $product->category->name }}</option>
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
                                <textarea
                                  id="descriptionEditor"
                                  name="description"
                                >{!! $product->description !!}</textarea>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col text-right">
                              <button
                                type="submit"
                                class="btn btn-success px-5 btn-block"
                              >
                                Update Product
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="row mt-4">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-body">
                        <div class="row">
                            @forelse ($product->galleries as $gallery)
                            <div class="col-md-4">
                              <div class="gallery-container">
                                <img
                                  src="{{ Storage::url($gallery->photo_url) }}"
                                  alt="images-product"
                                  class="w-100"
                                  style="object-fit: cover; height:250px; width:250px; border-radius: 10px;"
                                />
                                <a href="{{ route('dashboard-product-gallery-delete', $gallery->id) }}" class="delete-gallery">
                                  <img src="/images/icon-remove.svg" alt="" />
                                </a>
                              </div>
                            </div>
                            @empty
                            <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
                                Tidak ada Foto!
                            </div>
                            @endforelse
                          <div class="col-12 mt-3">
                            <form action="{{ route('dashboard-product-gallery-upload') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="products_id" value="{{ $product->id }}">

                                <input type="file" name="photo_url" id="file" style="display: none" onchange="form.submit()"/>
                            <button
                                type="button"
                                class="btn btn-secondary btn-block"
                                onclick="thisFileUpload()"
                            >
                              Add Photo
                            </form>
                            </button>
                          </div>
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
      $('#menu-toggle').click(function (event) {
        event.preventDefault();
        $('#wrapper').toggleClass('toggled');
      });
    </script>
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
    <script>
      function thisFileUpload() {
        document.getElementById('file').click();
      }
    </script>
    <script>
      CKEDITOR.replace('descriptionEditor');
    </script>
@endpush
