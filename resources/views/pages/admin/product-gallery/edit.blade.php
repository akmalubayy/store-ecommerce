@extends('./layouts/admin')

@section('title')
    Product Gallery Admin - StorEcommerce
@endsection

@section('content')
<section
            class="section-content section-dashboard-theme"
            data-aos="fade-up"
          >
            <div class="container-fluid">
              <div class="dashboard-heading">
                <h2 class="dashboard-title">Edit Product Gallery Admin (Full Access)</h2>
                <p class="dashboard-subtitle">Edit Product Gallery</p>
              </div>
              <div class="dashboard-content">
                <div class="row">
                    <div class="col-md-12">
                        @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('gallery.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                     <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="productOwner">
                                                    Product
                                                </label>
                                                <select name="products_id" class="form-control">
                                                    <option value="">-- Pilih Product --</option>
                                                    @foreach ($products as $product)
                                                    <option value="{{ $product->id }}" selected>{{ $product->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                               <label for="imageUpload">Foto Product</label>
                                               <input type="file" name="photo_url" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col text-right">
                                            <button type="submit" class="btn btn-success px-5">
                                                Update Now
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </section>
@endsection

@push('addon-script')
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
    <script>
      CKEDITOR.replace('descriptionEditor');
    </script>
@endpush
