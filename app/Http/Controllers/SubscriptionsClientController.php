<?php

namespace App\Http\Controllers;

use App\Models\AppointmentsModel;
use App\Models\ClientModel;
use App\Models\ClientsModel;
use App\Models\CustomerDebtModel;
use App\Models\RoomsModel;
use App\Models\SubscriptionClientModel;
use App\Models\SubscriptionModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubscriptionsClientController extends Controller
{
    public function index($id)
    {
        $client = ClientsModel::where('id',$id)->first();
        $client->debt = CustomerDebtModel::where('client_id',$id)->sum('value');
        $data = SubscriptionClientModel::where('client_id',$id)->with('subscription')->get();
        return view('project.clients.subscriptions.index', ['data'=>$data , 'client'=>$client]);
    }

    public function add($client_id)
    {
        $client = ClientsModel::find($client_id);
        $subscriptions = SubscriptionModel::get();
        $rooms= RoomsModel::get();
        return view('project.clients.subscriptions.add_subscription_for_client', ['client'=>$client , 'subscriptions'=>$subscriptions , 'rooms'=> $rooms]);
    }

    public function create(Request $request)
    {
        $client = ClientsModel::where('id', $request->client_id)->first();
        $subscription = SubscriptionModel::where('id', $request->subscriptions_id)->first();

        // تحديث تاريخ نهاية الاشتراك للعميل
        if ($client->end_subscription == null) {
            $client->end_subscription = Carbon::now()->addDays($subscription->duration);
            $client->user_status = 'old';
        } else {
            $client->end_subscription = Carbon::parse($client->end_subscription)->addDays($subscription->duration);
        }
        $client->save();

        // إنشاء اشتراك جديد للعميل
        $data = new SubscriptionClientModel();
        $data->client_id = $request->client_id;
        $data->subscriptions_id = $request->subscriptions_id;
        $data->insert_at = Carbon::now();
        $data->price = $subscription->price;
        $data->duration = $subscription->duration;
        $data->discount = $request->discount;
        $data->price_after_discount = $request->price_after_discount;
        $data->status = 'active';

        // تسجيل مديونية العميل
        $customer_debt_creditor = new CustomerDebtModel();
        $customer_debt_creditor->client_id = $request->client_id;
        $customer_debt_creditor->value = $subscription->price;
        $customer_debt_creditor->type = 'creditor';
        $customer_debt_creditor->insert_at = Carbon::now();
        $customer_debt_creditor->discount = $request->discount;
        $customer_debt_creditor->total_amount = $request->price_after_discount;
        $customer_debt_creditor->notes = $subscription->name;
        $customer_debt_creditor->save();

        // تسجيل دفعة العميل
        $customer_debt_debtor = new CustomerDebtModel();
        $customer_debt_debtor->client_id = $request->client_id;
        $customer_debt_debtor->value = $request->amount_paid * -1;
        $customer_debt_debtor->type = 'debtor';
        $customer_debt_debtor->insert_at = Carbon::now();
        $customer_debt_debtor->discount = 0;
        $customer_debt_debtor->total_amount = $request->amount_paid;
        $customer_debt_debtor->notes = 'تسديد دفعة للاشتراك';
        $customer_debt_debtor->save();

        // توليد الزيارات المجدولة بناءً على مدة الاشتراك
        $weeks = ceil($subscription->duration / 7);
        $startDate = Carbon::parse($client->end_subscription)->subDays($subscription->duration);

        for ($i = 0; $i < $weeks; $i++) {
            $visit = new AppointmentsModel();
            $visit->customer_id = $request->client_id;
            $visit->room_id = $request->room_id;
            $visit->appointment_date = $startDate->copy()->addDays($i * 7);
            $visit->save();
        }

        if ($data->save()) {
            return redirect()->route('clients.subscriptions.index', ['client_id' => $request->client_id])->with(['success' => 'تم اضافة الاشتراك بنجاح']);
        }
    }
}
