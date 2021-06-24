@extends('./layouts/admin')

@section('title')
    User Admin - StorEcommerce
@endsection

@section('content')
<section
            class="section-content section-dashboard-theme"
            data-aos="fade-up"
          >
            <div class="container-fluid">
              <div class="dashboard-heading">
                <h2 class="dashboard-title">User Admin (Full Access)</h2>
                <p class="dashboard-subtitle">Create New User</p>
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
                                <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="nameUser">
                                                    Nama User
                                                </label>
                                                <input type="text" name="name" class="form-control" placeholder="Masukan Nama Lengkap" value="{{ old('name') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="emailUser">
                                                    Email User
                                                </label>
                                                <input type="email" name="email" class="form-control" placeholder="Masukan email" value="{{ old('email') }}" required>
                                            </div>
                                        </div>
                                         <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="passwordUser">
                                                    Password User
                                                </label>
                                                <input type="password" name="password" class="form-control" placeholder="Masukan Password" value="{{ old('password') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="roles">
                                                    Roles
                                                </label>
                                                <select name="roles" id="" class="form-control" required>
                                                    <option value="ADMIN">Admin</option>
                                                    <option value="USER">User</option>
                                                </select>
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
