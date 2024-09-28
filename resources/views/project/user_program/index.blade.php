@extends('layouts.app')
@section('title')
    برامج العميل
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('program.user_program.add')}}" class="btn btn-primary">اضافة برنامج</a>
                </div>
            </div>
        </div>
    </div>
@endsection
