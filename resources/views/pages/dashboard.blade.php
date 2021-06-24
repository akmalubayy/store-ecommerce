@extends('./layouts/dashboard')

@section('title')
    Dashboard - StorEcommerce
@endsection

@section('content')
<section
            class="section-content section-dashboard-theme"
            data-aos="fade-up"
          >
            <div class="container-fluid">
              <div class="dashboard-heading">
                <h2 class="dashboard-title">Dashboard</h2>
                <p class="dashboard-subtitle">Look what you hace made today!</p>
              </div>
              <div class="dashboard-content">
                <div class="row">
                  <div class="col-md-4">
                    <div class="card mb-2">
                      <div class="card-body">
                        <div class="dashboard-card-title">Customer</div>
                        <div class="dashboard-card-subtitle">{{ $customer }}</div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="card mb-2">
                      <div class="card-body">
                        <div class="dashboard-card-title">Revenue</div>
                        <div class="dashboard-card-subtitle">@currency($revenue)</div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="card mb-2">
                      <div class="card-body">
                        <div class="dashboard-card-title">Transaction</div>
                        <div class="dashboard-card-subtitle">{{ $transaction_count }}</div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col-12 mt-2">
                    <h5 class="mb-3">Recent Transactions</h5>
                    @forelse ($transaction_data as $transaction)
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
          </section>
@endsection
