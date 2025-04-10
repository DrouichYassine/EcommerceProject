<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Product Management</title>
    @include('admin.css')
    <style>
      .form-control {
        color: white !important;
      }
      .form-control::placeholder {
        color: #6c757d !important;
      }
    </style>
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
                    <h4 class="card-title">Add Product</h4>
                    
                    @if(session()->has('message'))
                      <div class="alert alert-success">
                        {{ session()->get('message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      </div>
                    @endif
                    
                    <form class="forms-sample" action="{{ url('/add_product') }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group">
                        <label for="title">Product Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Product Title" required>
                      </div>
                      <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" rows="4"></textarea>
                      </div>
                      <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" class="form-control" name="price" placeholder="Price" required>
                      </div>
                      <div class="form-group">
                        <label for="discount_price">Discount Price</label>
                        <input type="number" class="form-control" name="discount_price" placeholder="Discount Price">
                      </div>
                      <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" class="form-control" name="quantity" placeholder="Quantity" required min="0">
                      </div>
                      <div class="form-group">
                          <label for="category_id">Category</label>
                          <select class="form-control" name="category_id" required>
                              <option value="">Select Category</option>
                              @foreach($categories as $category)
                                  <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id ?? '') == $category->id)>
                                      {{ $category->category_name }}
                                  </option>
                              @endforeach
                          </select>
                      </div>
                      <div class="form-group">
                        <label>Product Image</label>
                        <!-- Replace the custom file upload with a simpler implementation -->
                        <div class="input-group">
                          <input type="file" name="image" class="form-control" required style="height: auto;">
                        </div>
                      </div>
                      <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Products</h4>
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>Quantity</th>
                            <th>Image</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($products as $product)
                          <tr>
                            <td>{{ $product->title }}</td>
                            <td>{{ Str::limit($product->description, 30) }}</td>
                            <td>{{ $product->category }}</td>
                            <td>${{ $product->price }}</td>
                            <td>${{ $product->discount_price }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td><img src="/product/{{ $product->image }}"></td>
                            <td>
                              <a href="{{ url('edit_product', $product->id) }}" class="btn btn-primary">Edit</a>
                              <a onclick="return confirm('Are you sure you want to delete this?')" href="{{ url('delete_product', $product->id) }}" class="btn btn-danger">Delete</a>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
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