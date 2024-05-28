@extends('Pages.master')
@section('pages', 'Dashboard')
@section('description', 'Here are all our product with the specified details')
@section('content')

    @if (session('user')->isAdmin)

        <div class="row">
            <div class="col-3">
                <div class="card">
                    <div class="card-body d-flex align-items-center justify-content-center">
                        <div class="row w-100 text-center">
                            <div class="col">
                                <i class="bi bi-people-fill" style="font-size: 2rem; color: #3f5491;"></i>
                                <h6 class="text-muted font-semibold">Jumlah User</h6>
                                <h3 class="font-extrabold mb-0">{{ $user->count() }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body d-flex align-items-center justify-content-center">
                        <div class="row w-100 text-center">
                            <div class="col">
                                <i class="bi bi-inboxes-fill" style="font-size: 2rem; color: #3f5491;"></i>
                                <h6 class="text-muted font-semibold">Jumlah Produk</h6>
                                <h3 class="font-extrabold mb-0">{{ $product->count() }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body d-flex align-items-center justify-content-center">
                        <div class="row w-100 text-center">
                            <div class="col">
                                <i class="bi bi-stickies-fill" style="font-size: 2rem; color: #3f5491;"></i>
                                <h6 class="text-muted font-semibold">Jumlah Category</h6>
                                <h3 class="font-extrabold mb-0">{{ $category->count() }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body d-flex align-items-center justify-content-center">
                        <div class="row w-100 text-center">
                            <div class="col">
                                <i class="bi bi-clipboard-check-fill" style="font-size: 2rem; color: #3f5491;"></i>
                                <h6 class="text-muted font-semibold">Jumlah Order</h6>
                                <h3 class="font-extrabold mb-0">{{ $order->count() }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-body d-flex align-items-center justify-content-center">
                        <div class="row w-50 text-center">
                            <i class="bi bi-bag-check-fill" style="font-size: 3rem; color: #3f5491;"></i>
                            <div class="col">
                                <h6 class="text-muted font-semibold">Total Produk Terjual</h6>
                                <h3 class="font-extrabold mb-0">{{ $totalProductsSold }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-body d-flex align-items-center justify-content-center">
                        <div class="row w-50 text-center">
                            <i class="bi bi-currency-exchange" style="font-size: 3rem; color: #3f5491;"></i>
                            <div class="col">
                                <h6 class="text-muted font-semibold">Total Pendapatan</h6>
                                <h3 class="font-extrabold mb-0">{{ $totalRevenue }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endif

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">All Products</h5>
        </div>
        <div class="card-body">
            <div class="row gallery" data-bs-toggle="modal" data-bs-target="#galleryModal">
                @foreach ($product as $item)
                    <div class="col-6 col-sm-6 col-lg-3 mt-2 mt-md-0 mb-md-0 mb-2">
                        <a href="#">
                            <img class="w-100" src="{{ asset('storage/images/' . $item->pictures) }}"
                                data-bs-target="#Gallerycarousel" data-bs-slide-to="{{ $loop->index }}" />
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="modal fade" id="galleryModal" tabindex="-1" role="dialog" aria-labelledby="galleryModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="galleryModalTitle">Product Details</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="Gallerycarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($product as $index => $item)
                                <div class="carousel-item{{ $index === 0 ? ' active' : '' }}">
                                    <img class="d-block w-100" src="{{ asset('storage/images/' . $item->pictures) }}"
                                        alt="{{ $item->name }}">
                                    <hr>
                                    <p>{{ $item->name }}</p>
                                    <p>{{ $item->description }}</p>
                                </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#Gallerycarousel" role="button" type="button"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        </a>
                        <a class="carousel-control-next" href="#Gallerycarousel" role="button" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        </a>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection
