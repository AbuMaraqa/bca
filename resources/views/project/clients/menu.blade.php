<div class="row mb-2">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h4>العميل : <span>{{ $client->name }}</span></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mb-2">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <a href="{{ route('clients.index') }}" class="btn btn-primary">قائمة العملاء</a>
                        <a href="{{ route('clients.edit', ['id' => $client->id]) }}" class="btn btn-primary">تفاصيل
                            العميل</a>
                        {{-- <a href="{{ route('clients.details', ['client_id' => $client->id]) }}"
                            class="btn btn-primary">استبيان العميل</a> --}}
                        @if (auth()->user()->user_role == 'admin')
                            <a href="{{ route('reading_users.details', ['client_id' => $client->id]) }}"
                                class="btn btn-primary">قراءات العميل</a>
                        @endif
                        @if (auth()->user()->user_role == 'admin')
                            <a href="{{ route('customers_debt.index', ['client_id' => $client->id]) }}"
                                class="btn btn-primary">ديون العميل</a>
                        @endif
                        @if (auth()->user()->user_role == 'admin' || auth()->user()->user_role == 'reception')
                            <a href="{{ route('clients.subscriptions.index', ['client_id' => $client->id]) }}"
                                class="btn btn-primary">اشتراكات العميل</a>
                        @endif
                        @if (auth()->user()->user_role == 'admin')
                            <a href="{{ route('program.user_program.user_program_list', ['client_id' => $client->id]) }}"
                                class="btn btn-primary">برامج
                                العميل</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
