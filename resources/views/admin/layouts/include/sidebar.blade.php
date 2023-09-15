<div class="sidebar">
    <a class="{{ Request::routeIs('admin.dashboard') ? 'active' : '' }}" href="{{route('admin.dashboard')}}">Dashboard</a>
    <a class="{{ Request::routeIs('admin.product.*') ? 'active' : '' }}" href="{{route('admin.product.index')}}">Product</a>
  </div>
