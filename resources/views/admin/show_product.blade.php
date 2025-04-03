<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.css')
    <style type="text/css">
      .center {
        margin: auto;
        width: 90%;
        border: 2px solid white;
        margin-top: 40px;
      }
      .font_size {
        font-size: 40px;
        padding-bottom: 40px;
        text-align: center;
      }
      .img_size {
        width: 100px;
        height: 100px;
        object-fit: cover;
      }
      .th_color {
        background-color: skyblue;
        color: black;
      }
      .th_deg {
        padding: 15px;
        font-weight: bold;
      }
      .td_deg {
        padding: 10px;
      }
      .alert {
        margin: 20px auto;
        width: 80%;
      }
      .action-buttons {
        display: flex;
        gap: 10px;
        justify-content: center;
      }
      .delete-btn {
        background-color: #dc3545;
        color: white;
        padding: 8px 15px;
        border-radius: 5px;
        text-decoration: none;
        transition: all 0.3s;
      }
      .edit-btn {
        background-color: #007bff;
        color: white;
        padding: 8px 15px;
        border-radius: 5px;
        text-decoration: none;
        transition: all 0.3s;
      }
      .delete-btn:hover {
        background-color: #c82333;
        transform: translateY(-2px);
      }
      .edit-btn:hover {
        background-color: #0069d9;
        transform: translateY(-2px);
      }
    </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')
      <!-- partial -->
      @include('admin.header')
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          
          @if(session()->has('message'))
            <div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              {{ session()->get('message') }}
            </div>
          @endif
          
          <h1 class="font_size">All Products</h1>
          
          <table class="center">
            <thead>
              <tr class="th_color">
                <th class="th_deg">ID</th>
                <th class="th_deg">Product Title</th>
                <th class="th_deg">Description</th>
                <th class="th_deg">Category</th>
                <th class="th_deg">Price</th>
                <th class="th_deg">Discount Price</th>
                <th class="th_deg">Quantity</th>
                <th class="th_deg">Image</th>
                <th class="th_deg">Actions</th>
              </tr>
            </thead>
            <tbody>
              @php
                // Handle both potential variable names from controller
                $productData = $products ?? $product ?? collect();
              @endphp
              
              @if(count($productData) > 0)
                @foreach($productData as $item)
                  <tr>
                    <td class="td_deg">{{ $item->id }}</td>
                    <td class="td_deg">{{ $item->title }}</td>
                    <td class="td_deg">{{ \Illuminate\Support\Str::limit($item->description, 30) }}</td>
                    <td class="td_deg">{{ $item->category }}</td>
                    <td class="td_deg">${{ $item->price }}</td>
                    <td class="td_deg">{{ $item->discount_price ? '$'.$item->discount_price : 'N/A' }}</td>
                    <td class="td_deg">{{ $item->quantity }}</td>
                    <td class="td_deg">
                      <img class="img_size" src="/product/{{ $item->image }}">
                    </td>
                    <td class="td_deg">
                      <div class="action-buttons">
                        <a class="edit-btn" href="{{ url('update_product', $item->id) }}">Edit</a>
                        <a class="delete-btn" href="{{ url('delete_product', $item->id) }}" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                      </div>
                    </td>
                  </tr>
                @endforeach
              @else
                <tr>
                  <td colspan="9" class="text-center">No products found</td>
                </tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>
      <!-- container-scroller -->
      <!-- plugins:js -->
      @include('admin.script')
      <!-- End custom js for this page -->
    </div>
  </body>
</html>