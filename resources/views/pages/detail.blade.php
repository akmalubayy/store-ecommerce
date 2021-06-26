@extends('layouts.app')

@section('title')
    Details Product - StorEcommerce
@endsection

@section('content')

        <!-- Page Content -->
        <div class="page-content page-details">
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
                                        <a href="{{ route('home') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active">
                                        Product Details
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Section Gallery slider -->
            <section class="store-gallery" id="gallery">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8" data-aos="zoom-in">
                            <transition name="slide-fade" mode="out-in">
                                <img
                                    :src="photos[activePhoto].url"
                                    :key="photos[activePhoto].id"
                                    class="w-100 main-image"
                                    alt="img-product-collection"
                                />
                            </transition>
                        </div>
                        <div class="col-lg-2">
                            <div class="row">
                                <div
                                    class="col-3 col-lg-12 mt-2 mt-lg-0"
                                    v-for="(photo, index) in photos"
                                    :key="photo.id"
                                    data-aos="zoom-in"
                                    data-aos-delay="100"
                                >
                                    <a href="#" @click="changeActive(index)">
                                        <img
                                            :src="photo.url"
                                            class="w-100 thumbnail-image"
                                            :class="{ active: index == activePhoto }"
                                            alt="image-collection"
                                        />
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <div class="store detail-container mt-4" data-aos="fade-up">
                <!-- Section Details heading -->
                <section class="store-heading">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8">
                                <h1>{{ $product->name }}</h1>
                                <div class="owner">By {{ $product->user->store_name ? $product->user->store_name : $product->user->name }}</div>
                                <div class="price">Rp. {{ number_format($product->price) }}</div>
                            </div>
                            <div class="col-lg-2" data-aos="zoom-in">
                                @auth
                                <form action="{{ route('add-product', $product->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <button
                                        type="submit"
                                        class="btn btn-success px-4 text-white btn-block mb-3"
                                    >
                                        Add to Card
                                    </button>
                                </form>
                                @else
                                <a
                                    href="{{ route('login') }}"
                                    class="btn btn-success px-4 text-white btn-block mb-3"
                                    style="font-size: 15px;"
                                >
                                    Silahkan Login
                                </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section Details Description -->
                <section class="store-description">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-8">
                                <p>
                                    {!! $product->description !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section Review -->
                <section class="store-review">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-8 mt-5 mb-3">
                                <h5>Customer Review ({{ $product->comment->count() }})</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-lg-8">
                                <ul class="list-unstyled">
                                    @forelse ($product->comment as $review )
                                    <li class="media">
                                        <img
                                            src="@if ($review->user->photo_url != NULL)
                                                {{ Storage::url($review->user->photo_url) }}
                                            @else
                                                https://ui-avatars.com/api/?name={{$review->user->name}}
                                            @endif"
                                            alt="testimonial-img"
                                            class="mr-4 rounded-circle"
                                        />
                                        <div class="media-body">
                                            <h5 class="mt-2 mb-1">{{ $review->user->name }}</h5>
                                           {!! $review->post !!}
                                        </div>
                                    </li>
                                    @empty
                                    <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
                                        Tidak ada Review Di Produk Ini!
                                    </div>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>
                @auth
                <section class="store-review-comment mt-5">
                   <div class="container">
                        <div class="row">
                            <div class="col-8">
                                <form action="{{ route('product.comment.store', $product) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                        <label for="comment">Comment here</label>
                                        <textarea name="post" id="descriptionEditor" class="form-control"></textarea>
                                        <button type="submit" class="btn btn-success mt-3">Comment</button>
                                </form>
                            </div>
                       </div>
                   </div>
               </section>
                @endauth
            </div>
        </div>
@endsection

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
        <script>
            var gallery = new Vue({
                el: "#gallery",
                mounted() {
                    AOS.init();
                },

                data: {
                    activePhoto: 0,
                    photos: [
                        @foreach($product->galleries as $gallery)
                            {
                                id: {{ $gallery->id }},
                                url: "{{ Storage::url($gallery->photo_url) }}"
                            },
                        @endforeach
                    ]
                },
                methods: {
                    changeActive(id) {
                        this.activePhoto = id;
                    }
                }
            });
        </script>
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
        <script>
        CKEDITOR.replace('descriptionEditor');
        </script>
@endpush
