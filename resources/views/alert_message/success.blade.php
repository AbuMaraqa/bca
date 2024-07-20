@if(\Illuminate\Support\Facades\Session::has('success'))
    <p class="alert alert-success">{{ session('success') }}</p>
@endif
