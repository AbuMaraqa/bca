@extends('layouts.app')
@section('title')
    اضافة اضافة تعليمات
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
                        <form action="{{ route('program.instructions.create') }}" method="post">
                            @csrf
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group input-group-outline my-3">
                                        <input id="instructions_name" required name="instructions_name" type="text" placeholder="اسم التعليمات" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div dir="rtl" id="editor">
                                    
                                </div>
                            </div>
                            <input type="hidden" name="instructions_note" id="instructions_note">
                            <div class="col-md-12 mt-2">
                                <button class="btn btn-success">حفظ</button>
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
    var quill = new Quill('#editor', {
        theme: 'snow', // يمكنك تغيير الثيم إلى 'bubble' إن أردت
        formats: ['direction', 'align'], // لتفعيل تنسيقات النص مثل الاتجاه والمحاذاة
        modules: {
            toolbar: [
                [{ 'direction': 'rtl' }], // زر لتحديد اتجاه النص
                ['bold', 'italic', 'underline'], // أزرار التنسيق
                [{ 'align': [] }] // خيارات المحاذاة
            ]
        }
    });

    // التقاط حدث الإرسال للنموذج
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
