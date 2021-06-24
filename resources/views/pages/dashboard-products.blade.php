@extends('./layouts/dashboard')

@section('title')
    My Products - StorEcommerce
@endsection

@section('content')
 <section
            class="section-content section-dashboard-theme"
            data-aos="fade-down"
          >
            <div class="container-fluid">
              <div class="dashboard-heading">
                <h2 class="dashboard-title">My Products</h2>
                <p class="dashboard-subtitle">Manage it well and get money</p>
              </div>
              <div class="dashboard-content">
                <div class="row">
                  <div class="col-12">
                    <a
                      href="{{ route('dashboard-product-create') }}"
                      class="btn btn-success"
                    >
                      Add New Product
                    </a>
                  </div>
                </div>
                <div class="row mt-4">
                    @forelse ($products as $product)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <a
                      href="{{ route('dashboard-product-details', $product->id) }}"
                      class="card card-dashboard-product d-block"
                    >
                      <div class="card-body">
                        <img
                          src="{{ Storage::url($product->galleries->first()->photo_url ?? '../images/img-no-available.jpg') }}"
                          alt=""
                          class="w-100 mb-2"
                          style="object-fit: cover; width:250px; height:250px;"
                        />
                        <div class="product-title">{{ $product->name }}</div>
                        <div class="product-category">{{ $product->category->name }}</div>
                      </div>
                    </a>
                  </div>
                    @empty
                    <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
                        Tidak ada data produk!
                    </div>
                    @endforelse
                </div>
              </div>
            </div>
          </section>
@endsection
