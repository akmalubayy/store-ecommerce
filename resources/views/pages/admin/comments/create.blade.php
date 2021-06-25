@extends('./layouts/admin')

@section('title')
    Product Admin - StorEcommerce
@endsection

@section('content')
<section
            class="section-content section-dashboard-theme"
            data-aos="fade-up"
          >
            <div class="container-fluid">
              <div class="dashboard-heading">
                <h2 class="dashboard-title">Product Admin (Full Access)</h2>
                <p class="dashboard-subtitle">Create New Product</p>
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
                                <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="nameProduct">
                                                    Nama Produk
                                                </label>
                                                <input type="text" name="name" class="form-control" placeholder="Masukan nama kategori produk" value="{{ old('name') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="productOwner">
                                                    Product Owner
                                                </label>
                                                <select name="users_id" id="productOwner" class="form-control">
                                                    <option value="" disabled selected>-- Pilih Owner --</option>
                                                    @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="productCategory">
                                                    Product Category
                                                </label>
                                                <select name="categories_id" id="productCategory" class="form-control">
                                                    <option value="" disabled selected>-- Pilih Category --</option>
                                                   @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                   @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="priceProduct">Price</label>
                                                <input type="number" name="price" id="" class="form-control" placeholder="Masukan Harga" value="{{ old('price') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                    <label for="description">Description</label>
                                                    <textarea
                                                    type="text" class="form-control" id="descriptionEditor" name="description" cols="30" rows="4" placeholder="Type here...">
                                                        {{ old('description') }}
                                                    </textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col text-right">
                                            <button type="submit" class="btn btn-success px-5">
                                                Save Now
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
