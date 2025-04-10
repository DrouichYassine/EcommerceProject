<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Edit Product</title>
    @include('admin.css')
  </head>
  <body>
    <div class="container-scroller">
      @include('admin.sidebar')
      <div class="container-fluid page-body-wrapper">
        @include('admin.header')
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Edit Product</h4>
                    
                    @if(session()->has('message'))
                      <div class="alert alert-success">
                        {{ session()->get('message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      </div>
                    @endif
                    
                    <form class="forms-sample" action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      @method('PUT')
                      <div class="form-group">
                        <label for="title">Product Title</label>
                        <input type="text" class="form-control" name="title" value="{{ $product->title }}" required>
                      </div>
                      <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" rows="4">{{ $product->description }}</textarea>
                      </div>
                      <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" class="form-control" name="price" value="{{ $product->price }}" required>
                      </div>
                      <div class="form-group">
                        <label for="discount_price">Discount Price</label>
                        <input type="number" class="form-control" name="discount_price" value="{{ $product->discount_price }}">
                      </div>
                      <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" class="form-control" name="quantity" value="{{ $product->quantity }}" required min="0">
                      </div>
                      <div class="form-group">
                          <label for="category_id">Category</label>
                          <select class="form-control" name="category_id" required>
                              @foreach($categories as $category)
                                  <option value="{{ $category->id }}" 
                                      {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                      {{ $category->category_name }}
                                  </option>
                              @endforeach
                          </select>
                      </div>
                      <div class="form-group">
                        <label>Current Product Image</label>
                        <img height="100" width="100" src="/product/{{ $product->image }}">
                      </div>
                      <div class="form-group">
                        <label>Change Product Image</label>
                        <input type="file" name="image" class="file-upload-default">
                        <div class="input-group">
                          <input type="file" name="image" class="form-control"  style="height: auto;">
                        </div>
                      </div>
                      <button type="submit" class="btn btn-primary mr-2">Update</button>
                      <a href="{{ url('view_product') }}" class="btn btn-dark">Cancel</a>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @include('admin.script')
  </body>
</html>
