@if(\Illuminate\Support\Facades\Session::has('fail'))
    <p class="alert alert-danger text-white">{{ session('fail') }}</p>
@endif
