@extends('./layouts/dashboard')

@section('title')
    Account Settings - StorEcommerce
@endsection

@section('content')
  <!-- Content Section -->
          <section
            class="section-content section-dashboard-theme"
            data-aos="fade-down"
          >
            <div class="container-fluid">
              <div class="dashboard-heading">
                <h2 class="dashboard-title">My Account</h2>
                <p class="dashboard-subtitle">Update your current profile</p>
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
                    <form action="{{ route('dashboard-settings-redirect' ,'dashboard-account-settings') }}" method="POST" enctype="multipart/form-data" id="locations">
                    @csrf

                      <div class="card">
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-12 col-md-4">
                                    <img
                                        {{-- src="{{ Storage::url($user->photo_url ?? '../images/img-no-available.jpg') }}" --}}
                                        src="@if (Auth::user()->photo_url != NULL)
                                                {{ Storage::url(Auth::user()->photo_url) }}
                                            @else
                                                /images/img-no-available.jpg
                                            @endif"
                                        alt=""
                                        class="w-50  mb-3"
                                        style="border-radius: 10px;"
                                    />
                                    <input type="file" name="photo_url" id="" class="form-control">
                                </div>
                            </div>
                          <div class="row mb-2">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="name">Your Name</label>
                                <input
                                  type="text"
                                  class="form-control"
                                  id="name"
                                  name="name"
                                  value="{{ $user->name }}"
                                />
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="email">Your Email</label>
                                <input
                                  type="email"
                                  class="form-control"
                                  id="email"
                                  name="email"
                                  value="{{ $user->email }}"
                                />
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="addresOne">Address 1</label>
                                <input
                                  type="text"
                                  class="form-control"
                                  id="addressOne"
                                  name="address_one"
                                  value="{{ $user->address_one }}"
                                />
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="addressTwo">Address 2</label>
                                <input
                                  type="text"
                                  class="form-control"
                                  id="addressTwo"
                                  name="address_two"
                                  value="{{ $user->address_two }}"
                                />
                              </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="province">Province</label>
                                    <select name="provinces_id" class="form-control" id="provinces_id" v-if="provinces" v-model="provinces_id">
                                        <option value="{{ $user->provinces_id }}" selected disabled>-- Pilih Provinsi --</option>
                                        <option v-for="province in provinces" :value="province.id">@{{ province.name }}</option>
                                    </select>
                                    <select v-else class="form-control">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <select name="regencies_id" class="form-control" id="regencies_id" v-if="regencies" v-model="regencies_id">
                                        <option value="{{ $user->regencies_id }}" selected disabled>-- Pilih Kota --</option>
                                        <option v-for="regency in regencies" :value="regency.id">@{{ regency.name }}</option>
                                    </select>
                                    <select v-else class="form-control">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="postalCode">Postal Code</label>
                                <input
                                  type="text"
                                  class="form-control"
                                  id="zipCode"
                                  name="zip_code"
                                  value="{{ $user->zip_code }}"
                                />
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="country">Country</label>
                                <input
                                  type="text"
                                  class="form-control"
                                  id="country"
                                  name="country"
                                  value="{{ $user->country }}"
                                />
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="mobile">Mobile</label>
                                <input
                                  type="text"
                                  class="form-control"
                                  id="mobile"
                                  name="phoneNumber"
                                  value="{{ $user->phoneNumber }}"
                                />
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

    {{-- Indonregion --}}
    <script src="/vendor/vue/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        var locations = new Vue({
            el:"#locations",
            mounted() {
                AOS.init();
                this.getProvincesData();
            },

            data: {
                provinces: null,
                regencies: null,
                provinces_id: null,
                regencies_id: null,
            },

            methods: {
                getProvincesData() {
                    var self = this;
                    axios.get('{{ route('api-provinces') }}')
                    .then(function(response) {
                        self.provinces = response.data;
                    })
                },
                getRegenciesData() {
                    var self = this;
                    axios.get('{{ url('api/regencies') }}/' + self.provinces_id)
                    .then(function(response) {
                        self.regencies = response.data;
                    });
                },
            },
            // watch adalah sebuah state di mana jika ada perubahan maka akan berubah secara realtime
            watch: {
                provinces_id: function(val, oldVal) {
                    this.regencies_id = null;
                    this.getRegenciesData();
                }
            }
        });
    </script>

@endpush
