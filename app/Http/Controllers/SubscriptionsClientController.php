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
    // الحصول على بيانات العميل والاشتراك
    $client = ClientsModel::where('id', $request->client_id)->first();
    $subscription = SubscriptionModel::where('id', $request->subscriptions_id)->first();

    // تحديث تاريخ نهاية الاشتراك للعميل
    if ($client->end_subscription == null || Carbon::parse($client->end_subscription)->isPast()) {
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
    $data->save();

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

    // إعداد الحقول الخاصة بالموعد
    // $weeks = ceil($subscription->duration / 7); // حساب عدد الأسابيع بناءً على مدة الاشتراك
    // $sessionsPerMonth = 4; // عدد الجلسات الشهرية
    // $currentSessions = 0;
    // $startDate = Carbon::now(); // تاريخ البدء للجلسة الأولى

    // إنشاء سجل الموعد
    // $appointment = new AppointmentsModel();
    // $appointment->customer_id = $request->client_id;
    // $appointment->room_id = $request->room_id;

    // تعيين تاريخ الزيارة الحالية
    // $appointment->current_date = $startDate;

    // توليد مواعيد الجلسات بناءً على مدة الاشتراك
    // for ($i = 0; $i < $weeks; $i++) {
    //     if ($currentSessions >= $sessionsPerMonth) {
    //         break; // إذا كان العميل قد أكمل 4 جلسات لا حاجة لإنشاء المزيد
    //     }

    //     // تعيين موعد الزيارة التالية
    //     if ($currentSessions == 0) {
    //         $appointment->next_appointment = $startDate->copy()->addDays(7); // تعيين موعد الزيارة التالية
    //     }

    //     // تحديث عدد الجلسات الحالية
    //     $currentSessions++;
    // }
    // حفظ عدد الجلسات
    // $appointment->number_of_sessions = $sessionsPerMonth;
    // // $appointment->current_sessions = $currentSessions;
    // if($appointment->current_sessions == null){
    //     $appointment->current_sessions = 0;
    // }

    // // حفظ السجل في قاعدة البيانات
    // $appointment->save();

    // إعادة التوجيه مع رسالة نجاح
    return redirect()->route('clients.subscriptions.index', ['client_id' => $request->client_id])
                     ->with(['success' => 'تم إضافة الاشتراك بنجاح']);
}
    // public function create(Request $request)
    // {
    //     $client = ClientsModel::where('id', $request->client_id)->first();
    //     $subscription = SubscriptionModel::where('id', $request->subscriptions_id)->first();

    //     // تحديث تاريخ نهاية الاشتراك للعميل
    //     if ($client->end_subscription == null) {
    //         $client->end_subscription = Carbon::now()->addDays($subscription->duration);
    //         $client->user_status = 'old';
    //     } else {
    //         $client->end_subscription = Carbon::parse($client->end_subscription)->addDays($subscription->duration);
    //     }
    //     $client->save();

    //     // إنشاء اشتراك جديد للعميل
    //     $data = new SubscriptionClientModel();
    //     $data->client_id = $request->client_id;
    //     $data->subscriptions_id = $request->subscriptions_id;
    //     $data->insert_at = Carbon::now();
    //     $data->price = $subscription->price;
    //     $data->duration = $subscription->duration;
    //     $data->discount = $request->discount;
    //     $data->price_after_discount = $request->price_after_discount;
    //     $data->status = 'active';

    //     // تسجيل مديونية العميل
    //     $customer_debt_creditor = new CustomerDebtModel();
    //     $customer_debt_creditor->client_id = $request->client_id;
    //     $customer_debt_creditor->value = $subscription->price;
    //     $customer_debt_creditor->type = 'creditor';
    //     $customer_debt_creditor->insert_at = Carbon::now();
    //     $customer_debt_creditor->discount = $request->discount;
    //     $customer_debt_creditor->total_amount = $request->price_after_discount;
    //     $customer_debt_creditor->notes = $subscription->name;
    //     $customer_debt_creditor->save();

    //     // تسجيل دفعة العميل
    //     $customer_debt_debtor = new CustomerDebtModel();
    //     $customer_debt_debtor->client_id = $request->client_id;
    //     $customer_debt_debtor->value = $request->amount_paid * -1;
    //     $customer_debt_debtor->type = 'debtor';
    //     $customer_debt_debtor->insert_at = Carbon::now();
    //     $customer_debt_debtor->discount = 0;
    //     $customer_debt_debtor->total_amount = $request->amount_paid;
    //     $customer_debt_debtor->notes = 'تسديد دفعة للاشتراك';
    //     $customer_debt_debtor->save();

    //     // توليد الزيارات المجدولة بناءً على مدة الاشتراك
    //     $weeks = ceil($subscription->duration / 7);
    //     $startDate = Carbon::parse($client->end_subscription)->subDays($subscription->duration);

    //     for ($i = 0; $i < $weeks; $i++) {
    //         $visit = new AppointmentsModel();
    //         $visit->customer_id = $request->client_id;
    //         $visit->room_id = $request->room_id;
    //         $visit->appointment_date = $startDate->copy()->addDays($i * 7);
    //         $visit->status = 'not_attend';
    //         $visit->save();
    //     }

    //     if ($data->save()) {
    //         return redirect()->route('clients.subscriptions.index', ['client_id' => $request->client_id])->with(['success' => 'تم اضافة الاشتراك بنجاح']);
    //     }
    // }

    public function delete(Request $request) {
        // البحث عن العميل بناءً على `client_id` من الطلب
        $client = ClientsModel::find($request->client_id);

        // التحقق مما إذا كان العميل موجودًا ولديه اشتراك صالح
        if (!$client || $client->end_subscription == null || $client->end_subscription < Carbon::now()) {
            return redirect()->route('clients.subscriptions.index', ['client_id' => $request->client_id])->with(['fail' => 'لا يتوفر اشتراك ساري للعميل']);
        }

        // جلب الاشتراك بناءً على `subscription_id` من الطلب
        $data = SubscriptionClientModel::find($request->subscription_id);
        if (!$data) {
            return redirect()->route('clients.subscriptions.index', ['client_id' => $request->client_id])->with(['fail' => 'الاشتراك المطلوب غير موجود.']);
        }

        // حذف الاشتراك وتحديث تاريخ انتهاء الاشتراك للعميل
        if ($data->delete()) {
            $client->end_subscription = Carbon::parse($client->end_subscription)->subDays($data->duration);
            $client->save();

            // حساب الدين المتبقي بعد حذف الاشتراك
            $remainingDebt = $request->price_discount; // قد يمثل قيمة الاشتراك المتبقي عليه

            // إضافة سجل إلى جدول customer_debts لبيان أن العميل عليه مبلغ بعد حذف الاشتراك
            CustomerDebtModel::create([
                'client_id' => $client->id,
                'value' => abs($remainingDebt), // استخدام القيمة المطلقة
                'type' => 'debtor', // نوع "عليه" بعد حذف الاشتراك
                'insert_at' => Carbon::now(),
                'discount' => 0, // يمكنك تخصيص قيمة الخصم هنا إذا كان هناك خصم
                'total_amount' => abs($remainingDebt), // المبلغ الإجمالي
                'notes' => 'مبلغ على العميل بعد حذف الاشتراك',
            ]);

            // افتراضًا أن العميل دفع مبلغ معين عند حذف الاشتراك، سنضيف سجل "له" يوضح أنه تم دفع المبلغ
            $paidAmount = $request->price_discount; // قم بتحديد مبلغ الدفع المناسب هنا

            CustomerDebtModel::create([
                'client_id' => $client->id,
                'value' => abs($paidAmount), // استخدام القيمة المطلقة
                'type' => 'creditor', // نوع "له" بعد الدفع
                'insert_at' => Carbon::now(),
                'discount' => 0, // قيمة الخصم إذا كانت موجودة
                'total_amount' => abs($paidAmount), // القيمة الإجمالية المدفوعة
                'notes' => 'تم دفع المبلغ بعد حذف الاشتراك',
            ]);

            return redirect()->route('clients.subscriptions.index', ['client_id' => $data->client_id])->with(['success' => 'تم حذف الاشتراك بنجاح وإضافة سجلات الدين/الدفع']);
        }

        return redirect()->route('clients.subscriptions.index', ['client_id' => $request->client_id])->with(['fail' => 'حدث خطأ أثناء حذف الاشتراك.']);
    }

}
