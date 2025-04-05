<!DOCTYPE html>
<html lang="en">
  <head>
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
              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0">{{ $total_product }}</h3>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-success ">
                          <span class="mdi mdi-package-variant"></span>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Total Products</h6>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0">{{ $total_orders }}</h3>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-success">
                          <span class="mdi mdi-cart"></span>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Total Orders</h6>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0">{{ $total_users }}</h3>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-success">
                          <span class="mdi mdi-account-multiple"></span>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Total Customers</h6>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0">${{ $total_revenue }}</h3>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-success ">
                          <span class="mdi mdi-currency-usd"></span>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Total Revenue</h6>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                      <h4 class="card-title mb-0">Recent Orders</h4>
                      <div class="search-field">
                        <form class="d-flex" action="{{ url('/admin/dashboard') }}" method="GET">
                          <input type="text" name="search" class="form-control" placeholder="Search orders..." value="{{ request('search') }}">
                          <button type="submit" class="btn btn-primary ml-2">Search</button>
                        </form>
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>Customer</th>
                            <th>Product</th>
                            <th>Amount</th>
                            <th>Payment Status</th>
                            <th>Delivery Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse($orders as $order)
                          <tr>
                            <td>
                              @if(isset($order->first_name) && isset($order->last_name))
                                {{ $order->first_name }} {{ $order->last_name }}
                              @elseif(isset($order->first_name))
                                {{ $order->first_name }}
                              @elseif(isset($order->last_name))
                                {{ $order->last_name }}
                              @else
                                {{ $order->name ?? 'N/A' }}
                              @endif
                            </td>
                            <td>{{ $order->product_title }}</td>
                            <td><span class="font-weight-bold">${{ $order->price }}</span></td>
                            <td>
                              <span class="badge badge-{{ $order->payment_status == 'paid' ? 'success' : ($order->payment_status == 'pending' ? 'warning' : 'danger') }}">
                                {{ ucfirst($order->payment_status) }}
                              </span>
                            </td>
                            <td>
                              <span class="badge badge-{{ $order->delivery_status == 'delivered' ? 'success' : ($order->delivery_status == 'processing' ? 'info' : 'warning') }}">
                                {{ ucfirst($order->delivery_status) }}
                              </span>
                            </td>
                            <td>{{ $order->created_at->format('d M Y') }}</td>
                            <td>
                              <div class="dropdown">
                                <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" id="orderActionDropdown{{ $order->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Actions
                                </button>
                                <div class="dropdown-menu" aria-labelledby="orderActionDropdown{{ $order->id }}">
                                  <a class="dropdown-item" href="{{ url('/admin/orders/'.$order->id) }}">View Details</a>
                                  @if($order->delivery_status != 'delivered')
                                  <a class="dropdown-item" href="{{ url('/admin/orders/deliver/'.$order->id) }}">Mark as Delivered</a>
                                  @endif
                                  @if($order->payment_status != 'paid')
                                  <a class="dropdown-item" href="{{ url('/admin/orders/paid/'.$order->id) }}">Mark as Paid</a>
                                  @endif
                                </div>
                              </div>
                            </td>
                          </tr>
                          @empty
                          <tr>
                            <td colspan="7" class="text-center">No orders found</td>
                          </tr>
                          @endforelse
                        </tbody>
                      </table>
                    </div>
                    <div class="mt-3">
                      {{ $orders->links() }}
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