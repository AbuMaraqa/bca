@extends('layouts.app')
@section('title')
    تعديل تعليمات
@endsection
@section('content')
    <div class="row mb-3">
        <div class="col-md-12">
            @include('alert_message.success')
            @include('alert_message.fail')
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <form action="{{ route('program.instructions.update') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $data->id }}">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group input-group-outline my-3">
                                        <input id="instructions_name" required name="instructions_name" value="{{ $data->instructions_name }}" type="text" placeholder="اسم التعليمات" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div dir="rtl" id="editor">
                                    
                                </div>
                            </div>
                            <input type="hidden" value="{{ $data->instructions_note }}" name="instructions_note" id="instructions_note">
                            <div class="col-md-12 mt-2">
                                <button class="btn btn-success">تعديل</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('assets/js/plugins/quill.min.js') }}"></script>
    <script>
document.addEventListener('DOMContentLoaded', function () {
    // تهيئة محرر Quill
    var quill = new Quill('#editor', {
        theme: 'snow', 
        formats: ['direction', 'align'], 
        modules: {
            toolbar: [
                [{ 'direction': 'rtl' }],
                ['bold', 'italic', 'underline'],
                [{ 'align': [] }]
            ]
        }
    });

    // جلب البيانات من Blade لعرضها في المحرر
    var content = {!! json_encode($data->instructions_note) !!}; // استخدام json_encode لتجنب مشاكل التنسيق
    quill.root.innerHTML = content; // تعيين محتوى التعليمات إلى محرر Quill

    // عند إرسال النموذج
    var form = document.querySelector('form');
    form.onsubmit = function() {
        // الحصول على محتوى محرر Quill
        var quillContent = quill.root.innerHTML;
        // تعيين المحتوى إلى الحقل المخفي
        document.querySelector('#instructions_note').value = quillContent;
    };
});


    </script>
@endsection
