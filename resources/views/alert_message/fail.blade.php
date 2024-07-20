@if(\Illuminate\Support\Facades\Session::has('fail'))
    <p class="alert alert-danger">{{ session('fail') }}</p>
@endif
