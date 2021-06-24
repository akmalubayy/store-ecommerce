@extends('./layouts/admin')

@section('title')
    Category Admin - StorEcommerce
@endsection

@section('content')
<section
            class="section-content section-dashboard-theme"
            data-aos="fade-up"
          >
            <div class="container-fluid">
              <div class="dashboard-heading">
                <h2 class="dashboard-title">Category Admin (Full Access)</h2>
                <p class="dashboard-subtitle">Edit Category</p>
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
                                <form action="{{ route('category.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="nameCategory">
                                                    Nama Kategori
                                                </label>
                                                <input type="text" name="name" class="form-control" placeholder="Masukan nama kategori produk" value="{{ $item->name }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="photoCategory">
                                                    Foto Kategori
                                                </label>
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
