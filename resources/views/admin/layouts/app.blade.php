// ...existing code...

<ul class="list-unstyled components">
    // ...existing code...
    
    <!-- Products Menu -->
    <li>
        <a href="#productsSubmenu" data-toggle="collapse" aria-expanded="{{ request()->is('admin/products*') ? 'true' : 'false' }}">
            <i class="fas fa-box"></i> Products
        </a>
        <ul class="collapse {{ request()->is('admin/products*') ? 'show' : '' }}" id="productsSubmenu">
            <li class="{{ request()->routeIs('admin.products.index') ? 'active' : '' }}">
                <a href="{{ route('admin.products.index') }}">
                    <i class="fas fa-list"></i> View Products
                </a>
            </li>
            <li class="{{ request()->routeIs('admin.products.create') ? 'active' : '' }}">
                <a href="{{ route('admin.products.create') }}">
                    <i class="fas fa-plus"></i> Add Product
                </a>
            </li>
        </ul>
    </li>
    
    // ...existing code...
</ul>

// ...existing code...

<!-- Make sure these scripts are included at the bottom of the file -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function () {
        // Toggle sidebar
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        });
    });
</script>
// ...existing code...
