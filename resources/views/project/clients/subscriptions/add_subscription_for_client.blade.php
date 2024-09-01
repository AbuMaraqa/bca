@extends('layouts.app')
@section('title')
    اضافة اشتراك لعميل
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('clients.subscriptions.create') }}" method="post">
                        @csrf
                        <input type="hidden" value="{{ $client->id }}" name="client_id">
                        <input type="text" name="discount" id="discount_input_form">
                        <input type="text" name="price_after_discount" id="total_input_form">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h6>اضافة اشتراك للعميل <span class="text-primary">{{ $client->name }}</span></h6>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="input-group input-group-outline my-3">
                                                <select onchange="get_subscription_price(this)" required class="form-control" name="subscriptions_id" id="">
                                                    <option value="">اختر الاشتراك</option>
                                                    @foreach($subscriptions as $key)
                                                        <option data-price="{{ $key->price }}" value="{{ $key->id }}">{{ $key->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <span id="subscription_price" style="font-size:50px" class="text-bold"></span>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="input-group input-group-outline my-3">
                                                <input required type="number" name="amount_paid" id="amount_paid" placeholder="المبلغ المدفوع" style="height:120px;font-size:80px" class="form-control text-center">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <div class="input-group input-group-outline my-3">
                                                <input required type="number" id="discount" placeholder="الخصم" style="height:120px;font-size:80px" class="form-control text-center">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 justify-content-center align-content-center">
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" checked type="radio" name="flexRadioDefault" id="customRadio1">
                                            <label class="custom-control-label" for="customRadio1">خصم بالشيكل</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="customRadio2">
                                            <label class="custom-control-label" for="customRadio2">خصم بالنسبة المؤوية</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <p id="total_amount"></p>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="input-group input-group-outline my-3">
                                            <select required class="form-control" name="room_id" id="">
                                                <option value="">اختر غرفة</option>
                                                @foreach($rooms as $key)
                                                    <option value="{{ $key->id }}">{{ $key->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary">اضافة الاشتراك</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <h4>اضافة اشتراك للعميل</h4>
                                <span style="font-size: 200px" class="fa fa-address-card"></span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        var total_amount = 0;
        var amount_paid = 0;
        var discount = 0;
        var amount_after_discount = 0;
        var subscription_price = 0;

        function get_subscription_price(selectElement) {
            if (selectElement.value != ''){
                const selectedOption = selectElement.options[selectElement.selectedIndex];
                const price = selectedOption.getAttribute('data-price');
                document.getElementById('subscription_price').innerHTML = `سعر الاشتراك : ${price}`;
                subscription_price = price;
                calculate();
            }
            else{
                document.getElementById('subscription_price').innerHTML = '';
            }
        }

        $('#amount_paid').keyup(function () {
            if ($('#customRadio1').is(':checked')){
                total_amount = this.value - discount;
                calculate();
            }
        });

        $('input[name="flexRadioDefault"]').change(function(){
            if($('#customRadio1').is(':checked')) {
                amount_after_discount = $('#amount_paid').val() - $('#discount').val();
                calculate();
            } else if($('#customRadio2').is(':checked')) {
                amount_after_discount = subscription_price - ((subscription_price * $('#discount').val()) / 100);
                calculate();
            }
        });

        $('#discount').keyup(function () {
            discount = this.value;
            if ($('#customRadio1').is(':checked')){
                amount_after_discount = $('#amount_paid').val() - $('#discount').val();
                calculate();
            }
            else{
                amount_after_discount = subscription_price - ((subscription_price * $('#discount').val()) / 100);
                calculate();
            }
        });

        function calculate() {
            $('#total_amount').html(`
            <p>القيمة : ${subscription_price}</p>
            <p>الخصم : ${discount}</p>
            <p>المبلغ بعد الخصم : ${amount_after_discount}</p>
        `);
            $('#discount_input_form').val(discount);
            $('#total_input_form').val(amount_after_discount);
        }
    </script>
@endsection
