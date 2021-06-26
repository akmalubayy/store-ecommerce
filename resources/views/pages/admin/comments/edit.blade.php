@extends('./layouts/admin')

@section('title')
    Comment - StorEcommerce
@endsection

@section('content')
<section
            class="section-content section-dashboard-theme"
            data-aos="fade-up"
          >
            <div class="container-fluid">
              <div class="dashboard-heading">
                <h2 class="dashboard-title">Comment (Full Access)</h2>
                <p class="dashboard-subtitle">Edit Comment</p>
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
                                <form action="{{ route('comment.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="nameProduct">
                                                    Nama
                                                </label>
                                                <input type="text" name="name" class="form-control" value="{{ $item->user->name }}" required disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="nameProduct">
                                                    Product Name
                                                </label>
                                                <input type="text" name="users_id" class="form-control" value="{{ $item->product->name }}" required disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="nameProduct">
                                                    Product Owner
                                                </label>
                                                <input type="text" name="products_id" class="form-control" value="{{ $item->product->user->name }}" required disabled>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                    <label for="description">Comment Post</label>
                                                    <textarea
                                                    type="text" class="form-control" id="descriptionEditor" name="post" cols="30" rows="4" placeholder="Type here...">
                                                       {!! $item->post !!}
                                                    </textarea>
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
