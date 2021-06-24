@extends('layouts.app')

@section('title')
Cart - StorEcommerce
@endsection

@section('content')
    <!-- Page Content -->
    <div class="page-content page-cart">
      <!-- Section Breadcrumb -->
      <section
        class="store-breadcrumbs"
        data-aos="fade-down"
        data-aos-delay="100"
      >
        <div class="container">
          <div class="row">
            <div class="col-12">
              <nav>
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="/">Home</a>
                  </li>
                  <li class="breadcrumb-item active">Cart</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </section>

      <!-- Section cart store -->
      <section class="store-cart">
        <div class="container">
          <div class="row" data-aos="fade-up" data-aos-delay="100">
            <div class="col-12 table-responsive">
              <table class="table table-borderless table-cart">
                <thead>
                  <tr>
                    <td>Image</td>
                    <td>Name &amp; Seller</td>
                    <td>Price</td>
                    <td>Menu</td>
                  </tr>
                </thead>
                <tbody>
                    @php
                        $totalPrice = 0
                    @endphp
                    @forelse ($carts as $cart)
                    <tr>
                        <td style="width: 25%">
                            <img
                                src="@if ($cart->product->galleries->count())
                                   {{ Storage::url($cart->product->galleries->first()->photo_url) }}
                                @else
                                    ./images/img-no-available.jpg
                                @endif"
                                alt="image-cart"
                                class="cart-image"
                                style="object-fit: cover"
                            />
                        </td>
                        <td style="width: 35%">
                            <div class="product-title">{{ $cart->product->name }}</div>
                            <div class="product-subtitle">by {{ $cart->product->user->store_name ?? $cart->product->user->name }}</div>
                        </td>
                        <td style="width: 35%">
                            <div class="product-title">Rp. {{ number_format($cart->product->price) }}</div>
                            <div class="product-subtitle">IDR</div>
                        </td>
                        <td style="width: 20%">
                            <form action="{{ route('delete-product-cart', $cart->id) }}" method="POST">
                                @method('DELETE')
                                @csrf

                                <button type="submit" class="btn btn-remove-cart" onclick="return confirm('Yakin mau menghapus product ini dart cart?')"> Remove </button>
                            </form>
                        </td>
                  </tr>
                    @php
                        $totalPrice += $cart->product->price
                    @endphp
                    @empty
                    <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
                        Tidak ada Product Di Cart!
                    </div>
                    @endforelse
                </tbody>
              </table>
            </div>
          </div>
          <div class="row" data-aos="fade-up" data-aos-delay="150">
            <div class="col-12">
              <hr />
            </div>
            <div class="col-12">
              <div class="mb-4 heading-title">Shipping Details</div>
            </div>
          </div>
          <form action="{{ route('checkout') }}" method="POST" id="locations" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="total_price" value="{{ $totalPrice }}">
              <div class="row mb-2" data-aos="fade-up" data-aos-delay="200">
            <div class="col-md-6">
              <div class="form-group">
                <label for="address_one">Address 1</label>
                <input
                  type="text"
                  class="form-control"
                  id="address_one"
                  name="address_one"
                />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="address_two">Address 2</label>
                <input
                  type="text"
                  class="form-control"
                  id="address_two"
                  name="address_two"
                />
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="province">Province</label>
                <select name="provinces_id" class="form-control" id="provinces_id" v-if="provinces" v-model="provinces_id">
                  <option value="" selected disabled>-- Pilih Provinsi --</option>
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
                    <option value="" selected disabled>-- Pilih Kota --</option>
                    <option v-for="regency in regencies" :value="regency.id">@{{ regency.name }}</option>
                </select>
                <select v-else class="form-control">
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="zip_code">Postal Code</label>
                <input
                  type="text"
                  class="form-control"
                  id="zip_code"
                  name="zip_code"
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
                />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="phoneNumber">Mobile Number</label>
                <input
                  type="text"
                  class="form-control"
                  id="phoneNumber"
                  name="phoneNumber"
                  placeholder="+62"
                />
              </div>
            </div>
          </div>
          <div class="row" data-aos="fade-up" data-aos-delay="250">
            <div class="col-12">
              <hr />
            </div>
            <div class="col-12">
              <div class="mb-2 heading-title">Payment Informations</div>
            </div>
          </div>
          <div class="row" data-aos="fade-up" data-aos-delay="300">
            <div class="col-4 col-md-2">
              <div class="product-title">Rp.</div>
              <div class="product-subtitle">Country Tax</div>
            </div>
            <div class="col-4 col-md-3">
              <div class="product-title">Rp.</div>
              <div class="product-subtitle">Product Insurance</div>
            </div>
            <div class="col-4 col-md-2">
              <div class="product-title">Rp.</div>
              <div class="product-subtitle">Ship To Jakarta</div>
            </div>
            <div class="col-4 col-md-2">
              <div class="product-title text-success">@currency($totalPrice)</div>
              <div class="product-subtitle">Total</div>
            </div>
            <div class="col-12 col-md-3">
                {{-- @php
                    $carts = \App\Cart::where('users_id', Auth::user()->id)->count();
                @endphp --}}
                @if ($carts->count() > 0)
                <button
                  type="submit"
                  class="btn btn-success mt-4 px-4 btn-block checkout-button"
                  onclick="return confirm('Yakin tidak ingin tambah item lain?')"
                >
                  Checkout Now
                </button>
                @else
                <a
                  href="{{ route('home') }}"
                  class="btn btn-success mt-4 px-4 btn-block checkout-button"
                >
                  Go Shop!
                </a>

                @endif
            </div>
          </div>
          </form>
        </div>
      </section>
    </div>
@endsection

@push('addon-script')
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
