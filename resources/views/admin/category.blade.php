<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.css')
    <style type="text/css">
        .div-center{
            text-align: center;
            padding-top: 40px;
        }
        </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')
      <!-- partial -->
      @include('admin.header')
    <div class="main-panel">
      <div class="content-wrapper">
        @if(session()->has('message'))
      <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {{ session()->get('message') }}

      </div>
        @endif
        <div class="div-center"></div>
            <h1>Add Category</h1>
            
            @if(session()->has('message'))
            <div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              {{ session()->get('message') }}
            </div>
            @endif
            
            <form action="{{ url('/add_category') }}" method="POST">
              @csrf
              <div style="padding:15px;">
                <label>Category Name</label>
                <input type="text" name="category_name" class="form-control" placeholder="Write category name" style="color: white;" required>
              </div>
              
              <div style="padding:15px;">
                <input type="submit" class="btn btn-primary" value="Add Category">
              </div>
            </form>
            
            <table class="table table-bordered mt-4">
              <thead>
                <tr>
                    <th>Category Name</th>
                    <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($data as $data)
                <tr>
                    <td>{{ $data->category_name }}</td>
                    <td>
                      <a onclick="return confirm('Are you sure?')" 
                         href="{{ url('delete_category', $data->id) }}" 
                         class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                @endforeach
              </tbody>
            </table>
        </div>
      </div>
    </div></td>
   @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>