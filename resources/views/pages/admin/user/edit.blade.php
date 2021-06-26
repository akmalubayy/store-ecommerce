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
                <p class="dashboard-subtitle">Edit User</p>
              </div>
              <div class="dashboard-content">
                <div class="row">
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
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('user.update' , $data->id) }}" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <div class="row">
                                        <div class="col-12 col-md-4">
                                            <img
                                                src="{{ Storage::url($data->photo_url ?? '../images/img-no-available.jpg') }}"
                                                alt=""
                                                class="w-50 mb-3"
                                                style="border-radius: 10px;"
                                            />

                                        </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="nameUser">
                                                    Nama User
                                                </label>
                                                <input type="text" name="name" class="form-control" placeholder="Masukan Nama Lengkap" value="{{ $data->name }}" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="emailUser">
                                                    Email User
                                                </label>
                                                <input type="email" name="email" class="form-control" placeholder="Masukan email" value="{{ $data->email }}" required>
                                                @if ($data->email_verified_at == null)
                                                <p class="text-muted mt-1" style="font-size: 13px;">*Harap Verifikasi Email Anda</p>
                                                @endif
                                            </div>
                                        </div>
                                         <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="passwordUser">
                                                    Password User
                                                </label>
                                                <input type="password" name="password" class="form-control" placeholder="Masukan Password">
                                                <small class="text-muted">*Kosongkan Jika Tidak Ingin Mengganti Password</small>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="roles">
                                                    Roles
                                                </label>
                                                <select name="roles" id="" class="form-control" required>
                                                    <option value="{{ $data->roles }}" selected>Tidak diganti</option>
                                                    <option value="ADMIN">Admin</option>
                                                    <option value="USER">User</option>
                                                </select>
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
