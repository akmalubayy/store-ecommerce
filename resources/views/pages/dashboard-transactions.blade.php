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
                <h2 class="dashboard-title">Transactions</h2>
                <p class="dashboard-subtitle">
                  Big result start from the small one
                </p>
              </div>
              <div class="dashboard-content">
                <div class="row mt-3">
                  <div class="col-12 mt-2">
                    <ul
                      class="nav nav-pills mb-3"
                      id="pills-tab"
                      role="tablist"
                    >
                      <li class="nav-item" role="presentation">
                        <a
                          class="nav-link active"
                          id="sell-product-tab"
                          data-toggle="pill"
                          href="#sell-product"
                          role="tab"
                          aria-controls="sell-product"
                          aria-selected="true"
                          >Sell Product</a
                        >
                      </li>
                      <li class="nav-item" role="presentation">
                        <a
                          class="nav-link"
                          id="buy-product-tab"
                          data-toggle="pill"
                          href="#buy-product"
                          role="tab"
                          aria-controls="buy-product"
                          aria-selected="false"
                          >Buy Product</a
                        >
                      </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                      <div
                        class="tab-pane fade show active"
                        id="sell-product"
                        role="tabpanel"
                        aria-labelledby="sell-product-tab"
                      >
                      @forelse ($sellTransactions as $transaction)
                        <a
                            href="{{ route('dashboard-transactions-details', $transaction->id) }}"
                            class="card card-list d-block"
                        >
                            <div class="card-body">
                            <div class="row">
                                <div class="col-md-1">
                                <img
                                    src="{{ Storage::url($transaction->product->galleries->first()->photo_url ?? '../images/img-no-available.jpg') }}"
                                    alt="products-img-dashboard"
                                    class="img-transaction"
                                />
                                </div>
                                <div class="col-md-4">{{ $transaction->product->name ?? 'no data' }}</div>
                                <div class="col-md-3">{{ $transaction->transaction->user->name ?? 'no data' }}</div>
                                <div class="col-md-3">{{ $transaction->created_at->format('D, d M Y') ?? 'no data'}}</div>
                                <div class="col-md-1 d-none d-md-block">
                                <img
                                    src="/images/arrow_icon_right.svg"
                                    alt="arrow_right"
                                />
                                </div>
                            </div>
                            </div>
                        </a>
                    @empty
                        <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
                            Tidak ada Transaksi!
                        </div>
                    @endforelse
                      </div>
                      <div
                        class="tab-pane fade"
                        id="buy-product"
                        role="tabpanel"
                        aria-labelledby="buy-product-tab"
                      >
                        @forelse ($buyTransactions as $transaction)
                        <a
                            href="{{ route('dashboard-transactions-details', $transaction->id) }}"
                            class="card card-list d-block"
                        >
                            <div class="card-body">
                            <div class="row">
                                <div class="col-md-1">
                                <img
                                    src="{{ Storage::url($transaction->product->galleries->first()->photo_url ?? '../images/img-no-available.jpg') }}"
                                    alt="products-img-dashboard"
                                    class="img-transaction"
                                />
                                </div>
                                <div class="col-md-4">{{ $transaction->product->name ?? 'no data' }}</div>
                                <div class="col-md-3">{{ $transaction->transaction->user->name ?? 'no data' }}</div>
                                <div class="col-md-3">{{ $transaction->created_at->format('D, d M Y') ?? 'no data'}}</div>
                                <div class="col-md-1 d-none d-md-block">
                                <img
                                    src="/images/arrow_icon_right.svg"
                                    alt="arrow_right"
                                />
                                </div>
                            </div>
                            </div>
                        </a>
                    @empty
                        <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
                            Tidak ada Transaksi!
                        </div>
                    @endforelse
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
@endpush
