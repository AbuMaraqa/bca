@extends('layouts.app')
@section('title')
    الرئيسية
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h3> اهلا وسهلا بك {{ auth()->user()->name }}
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
