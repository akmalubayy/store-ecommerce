@extends('layouts.app')

@section('title')
    Category - StorEcommerce
@endsection

@section('content')
   <div class="page-content page-home">
      <!-- Section Trend Categories -->
      <section class="store-trend-categories">
        <div class="container">
          <div class="row">
            <div class="col-12" data-aos="fade-up">
               @if (request()->routeIs('categories'))
                    <h5>All Categories</h5>
                @else
                    <a href="{{ route('categories') }}" style="text-decoration: none; color:#212529;"><h5>All Categories</h5></a>
                @endif
            </div>
          </div>
          <div class="row">
              @php
                $incrementCategory = 0;
              @endphp
              @forelse ($categories as $category)
            <div
              class="col-6 col-md-3 col-lg-2"
              data-aos="fade-up"
              data-aos-delay="{{ $incrementCategory += 100 }}"
            >
              <a href="{{ route('categories-detail', $category->slug) }}" class="component-categories d-block">
                <div class="categories-image">
                  <img
                    src="{{ Storage::url($category->photo_url) }}"
                    alt="categories-gadgets-img"
                    class="w-100"
                  />
                </div>
                <p class="categories-text">{{ $category->name }}</p>
              </a>
            </div>
              @empty
                  <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
                      Tidak ada data category!
                  </div>
              @endforelse
          </div>
        </div>
      </section>

      <!-- Section New Product -->
      <section class="store-new-products">
        <div class="container">
          <div class="row">
            <div class="col-12" data-aos="fade-up">
              <h5>All Products</h5>
            </div>
          </div>
          <div class="row">
              @php
                  $incrementProduct = 0;
              @endphp
              @forelse ($products as $product)
            <div
              class="col-6 col-md-4 col-lg-3"
              data-aos="fade-up"
              data-aos-delay="{{ $incrementProduct += 100 }}"
            >
              <a href="{{ route('detail', $product->slug) }}" class="component-products d-block">
                <div class="products-thumbnail">
                  <div
                    class="products-image"
                    style="background-image: url('{{ $product->galleries->count() ? Storage::url($product->galleries->first()->photo_url) : './images/img-no-available.jpg' }}')">
                </div>
                </div>
                <div class="products-text">{{ $product->name }}</div>
                <div class="products-price">@currency($product->price)</div>
              </a>
            </div>
              @empty
                <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
                      Tidak ada data product!
                </div>
              @endforelse
          </div>
          <div class="col-12 mt-4 d-flex justify-content-center" data-aos="fade-up" data-aos-delay="{{ $incrementProduct += 100  }}">
              {{ $products->links() }}
          </div>
        </div>
      </section>
    </div>
@endsection
