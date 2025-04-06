@extends('home.userpage')

@section('content')
<div class="container mt-5 pt-5">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">Search Results for "{{ $query }}"</h2>
            
            @if(count($products) > 0)
                <p>Found {{ count($products) }} product(s)</p>
                
                <div class="row">
                    @foreach($products as $product)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <img src="/product/{{ $product->image }}" class="card-img-top p-3" alt="{{ $product->title }}" style="height: 250px; object-fit: contain;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->title }}</h5>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    @if($product->discount_price)
                                        <div>
                                            <span class="text-muted text-decoration-line-through">${{ $product->price }}</span>
                                            <span class="ms-2 text-danger">${{ $product->discount_price }}</span>
                                        </div>
                                    @else
                                        <span>${{ $product->price }}</span>
                                    @endif
                                </div>
                                <p class="card-text">{{ Str::limit($product->description, 100) }}</p>
                                <a href="{{ url('product_details', $product->id) }}" class="btn btn-outline-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-info">
                    No products found matching "{{ $query }}". Please try another search term.
                </div>
                <a href="{{ url('/') }}" class="btn btn-primary">Back to Home</a>
            @endif
        </div>
    </div>
</div>
@endsection
