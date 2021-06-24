@extends('./layouts/dashboard')

@section('title')
    Transactions - StorEcommerce
@endsection

@section('content')
  <!-- Content Section -->
          <section
            class="section-content section-dashboard-theme"
            data-aos="fade-down"
          >
            <div class="container-fluid">
              <div class="dashboard-heading">
                <h2 class="dashboard-title">#{{ $transaction->transaction->code }}</h2>
                <div class="store-breadcrumbs">
                  <div class="row">
                    <div class="col-12">
                      <nav>
                        <ol class="breadcrumb">
                          <li class="breadcrumb-item">
                            <a href="{{ url()->previous() }}"
                              >Transactions</a
                            >
                          </li>
                          <li class="breadcrumb-item active">Details</li>
                        </ol>
                      </nav>
                    </div>
                  </div>
                </div>
              </div>
              <div class="dashboard-content" id="transactionDetails">
                <div class="row mt-3">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-12 col-md-4">
                            <img
                              src="{{ Storage::url($transaction->product->galleries->first()->photo_url ?? '../images/img-no-available.jpg') }}"
                              alt=""
                              class="w-75 mb-3"
                            />
                          </div>
                          <div class="col-12 col-md-8">
                            <div class="row">
                              <div class="col-12 col-md-6">
                                <div class="product-title">Customer Name</div>
                                <div class="product-subtitle">
                                  {{ $transaction->transaction->user->name }}
                                </div>
                              </div>
                              <div class="col-12 col-md-6">
                                <div class="product-title">Product Name</div>
                                <div class="product-subtitle">
                                  {{ $transaction->product->name }}
                                </div>
                              </div>
                              <div class="col-12 col-md-6">
                                <div class="product-title">
                                  Date of Transaction
                                </div>
                                <div class="product-subtitle">
                                  {{ $transaction->transaction->created_at->format('D, d M Y') }}
                                </div>
                              </div>
                              <div class="col-12 col-md-6">
                                <div class="product-title">Payment Status</div>
                                <div class="product-subtitle text-danger">
                                  {{ $transaction->transaction->transaction_status }}
                                </div>
                              </div>
                              <div class="col-12 col-md-6">
                                <div class="product-title">Total Amount</div>
                                <div class="product-subtitle">Rp. {{ number_format($transaction->transaction->total_price) }}</div>
                              </div>
                              <div class="col-12 col-md-6">
                                <div class="product-title">Mobile</div>
                                <div class="product-subtitle">
                                  {{ $transaction->transaction->user->phoneNumber }}
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <form action="{{ route('dashboard-transactions-update', $transaction->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                        <div class="row">
                          <div class="col-12 mt-4">
                            <div class="row">
                              <div class="col-12 mb-3">
                                <div class="head-title">
                                  Shipping Information
                                </div>
                              </div>
                              <div class="col-12 col-md-6">
                                <div class="product-title">Address I</div>
                                <div class="product-subtitle">
                                  {{ $transaction->transaction->user->address_one }}
                                </div>
                              </div>
                              <div class="col-12 col-md-6">
                                <div class="product-title">Address II</div>
                                <div class="product-subtitle">
                                  {{ $transaction->transaction->user->address_two }}
                                </div>
                              </div>
                              <div class="col-12 col-md-6">
                                <div class="product-title">Province</div>
                                <div class="product-subtitle">{{ App\Models\Province::find($transaction->transaction->user->provinces_id)->name }}</div>
                              </div>
                              <div class="col-12 col-md-6">
                                <div class="product-title">City</div>
                                <div class="product-subtitle">{{ App\Models\Regency::find($transaction->transaction->user->regencies_id)->name }}</div>
                              </div>
                              <div class="col-12 col-md-6">
                                <div class="product-title">Postal Code</div>
                                <div class="product-subtitle">{{ $transaction->transaction->user->zip_code }}</div>
                              </div>
                              <div class="col-12 col-md-6">
                                <div class="product-title">Country</div>
                                <div class="product-subtitle">{{ $transaction->transaction->user->country }}</div>
                              </div>
                              <div class="col-md-3">
                                <div class="product-title">Shipping Status</div>
                                <select
                                  name="shipping_status"
                                  id="status"
                                  class="form-control"
                                  v-model="status"
                                >
                                  <option value="PENDING">PENDING</option>
                                  <option value="SHIPPING">SHIPPING</option>
                                  <option value="SUCCESS">SUCCESS</option>
                                </select>
                              </div>
                              <template v-if="status == 'SHIPPING' ">
                                <div class="col-md-3">
                                  <div class="product-title">Input Resi</div>
                                  <input
                                    type="text"
                                    class="form-control"
                                    name="resi"
                                    v-model="resi"
                                  />
                                </div>
                                <div class="col-md-2">
                                  <button
                                    type="submit"
                                    class="btn btn-success btn-block mt-4"
                                  >
                                    Update Resi
                                  </button>
                                </div>
                              </template>
                            </div>
                          </div>
                        </div>
                        <div class="row mt-4">
                          <div class="col-12 text-left">
                            <button type="submit" class="btn btn-success">
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
     <!-- Script Jquery -->
    <script>
      $('#menu-toggle').click(function (event) {
        event.preventDefault();
        $('#wrapper').toggleClass('toggled');
      });
    </script>
    <script src="/vendor/vue/vue.js"></script>
    <script>
      var transactionDetails = new Vue({
        el: '#transactionDetails',
        data: {
          status: '{{ $transaction->shipping_status }}',
          resi: '{{ $transaction->resi }}',
        },
      });
    </script>
@endpush
