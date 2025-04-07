<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.css')
    <style>form {
  display: flex;
  align-items: center;
  gap: 10px;
  margin: 12px 0;
  max-width: 500px;
}

select.form-control {
  padding: 8px 12px;
  border: 1px solid #ced4da;
  border-radius: 4px;
  background-color: #fff;
  font-size: 14px;
  flex-grow: 1;
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

select.form-control:focus {
  border-color: #80bdff;
  outline: 0;
  box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

.btn-primary {
  color: #fff;
  background-color: #007bff;
  border-color: #007bff;
  padding: 8px 16px;
  font-size: 14px;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.15s ease-in-out;
}

.btn-primary:hover {
  background-color: #0069d9;
  border-color: #0062cc;
}

.btn-primary:focus {
  
}

/* Status color indicators */
select.form-control option[value="pending"] {
  background-color: #ffeeba;
}

select.form-control option[value="processing"] {
  background-color: #b8daff;
}

select.form-control option[value="shipped"] {
  background-color: #c3e6cb;
}

select.form-control option[value="delivered"] {
  background-color: #d4edda;
}

select.form-control option[value="cancelled"] {
  background-color: red;
}

/* Responsive adjustments */
@media (max-width: 576px) {
  form {
    flex-direction: column;
    align-items: stretch;
    gap: 8px;
  }
}</style>
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
                      
                    </div>
                    <div class="table-responsive">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>Customer</th>
                            <th>Order Number</th>
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
                            <td class="font-weight-bold text-white">
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
                            <td><span class="font-weight-bold text-white">${{ $order->order_number }}</span></td>
                            
                            <td><span class="font-weight-bold text-white">${{ $order->total_amount }}</span></td>
                            <td>
                              <span class="badge badge-{{ $order->payment_status == 'paid' ? 'success' : ($order->payment_status == 'pending' ? 'warning' : 'danger') }}">
                                {{ ucfirst($order->payment_status) }}
                              </span>
                            </td>
                            <td>
                              <span class="badge badge-{{ $order->status == 'delivered' ? 'success' : ($order->status == 'processing' ? 'info' : 'warning') }}">
                                {{ ucfirst($order->status) }}
                              </span>
                            </td>
                            <td class="font-weight-bold text-white">{{ $order->created_at->format('d M Y') }}</td>
                            <td>
                            <form action="{{ route('update') }}" method="POST">                                @csrf
                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                                
                                <select name="status" class="form-control">
                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                    <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                    <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                                
                                <button type="submit" class="btn btn-primary">Update Status</button>
                            </form>
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
    <script>
      $(document).ready(function() {
        // Handle confirm action clicks with improved UX
        $('.confirm-action').on('click', function(e) {
          e.preventDefault();
          var message = $(this).data('confirm');
          var actionUrl = $(this).attr('href');
          
          // Highlight the clicked option
          $(this).addClass('active');
          
          if (confirm(message)) {
            window.location.href = actionUrl;
          } else {
            // Remove highlight if canceled
            $(this).removeClass('active');
          }
        });
        
        // Variable to store timeout for dropdown hiding
        var dropdownTimeout;
        
        // Enhanced hover functionality with reduced delay for dropdown buttons
        $('.dropdown').hover(
          function() {
            // Clear any existing timeout
            clearTimeout(dropdownTimeout);
            // Show dropdown immediately on hover
            $(this).find('.dropdown-menu').addClass('show');
          },
          function() {
            // Store 'this' reference for timeout function
            var $dropdown = $(this);
            // Set timeout to hide dropdown after very short delay (50ms)
            dropdownTimeout = setTimeout(function() {
              $dropdown.find('.dropdown-menu').removeClass('show');
            }, 50); // Reduced from 300ms to 50ms for faster hiding
          }
        );
        
        // Keep dropdown open when hovering directly on the menu
        $('.dropdown-menu').hover(
          function() {
            clearTimeout(dropdownTimeout);
          },
          function() {
            var $menu = $(this);
            dropdownTimeout = setTimeout(function() {
              $menu.removeClass('show');
            }, 50); // Reduced from 300ms to 50ms for faster hiding
          }
        );
        
        // Hide dropdowns when clicking elsewhere on the page
        $(document).on('click', function(e) {
          if (!$(e.target).closest('.dropdown').length) {
            $('.dropdown-menu').removeClass('show');
          }
        });
        
        // Enhanced hover effect for dropdown items with better visual feedback
        $('.dropdown-item').hover(
          function() {
            $(this).addClass('active');
            $(this).css('cursor', 'pointer');
          },
          function() {
            $(this).removeClass('active');
          }
        );
      });
    </script>
  </body>
</html>