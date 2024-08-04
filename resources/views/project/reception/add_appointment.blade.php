@extends('layouts.app')
@section('title')
    اضافة موعد
@endsection
@section('style')
    <link rel="canonical" href="https://www.creative-tim.com/learning-lab/bootstrap/choices/material-dashboard" />

@endsection
@section('content')
    <div class="row mb-3">
        <div class="col-md-12">
            @include('alert_message.success')
            @include('alert_message.fail')
        </div>
    </div>
    <div class="row">
        <form action="{{ route('supplements.create_appointment') }}" method="post" class="col-md-8">
            @csrf
            <input type="hidden" value="{{ $room_id }}" name="room_id">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <select class="form-control" name="customer_id" id="choices-button" placeholder="Departure">
                                        @foreach($clients as $key)
                                            <option value="{{ $key->id }}">{{ $key->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary">اضافة</button>

                    </div>
                </div>
        </form>
        <div class="col-md-4 text-center">
            <span style="font-size: 100px" class="fa fa-users"></span>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('assets/js/plugins/choices.min.js') }}" type="text/javascript"></script>

    <script type="text/javascript">
        if (document.getElementById('choices-button')) {
            var element = document.getElementById('choices-button');
            const example = new Choices(element, {});
        }
        var choicesTags = document.getElementById('choices-tags');
        var color = choicesTags.dataset.color;
        if (choicesTags) {
            const example = new Choices(choicesTags, {
                delimiter: ',',
                editItems: true,
                maxItemCount: 5,
                removeItemButton: true,
                addItems: true,
                classNames: {
                    item: 'badge rounded-pill choices-' + color + ' me-2'
                }
            });
        }
    </script>
@endsection
