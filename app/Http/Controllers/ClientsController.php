<?php

namespace App\Http\Controllers;

use App\Models\ClientModel;
use App\Models\ClientsModel;
use App\Models\CustomerDebtModel;
use App\Models\DiseasesModel;
use App\Models\ReadingUsersModel;
use App\Models\UserProgramMealModel;
use App\Models\UsersProgramModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    public function index()
    {
        return view('project.clients.index');
    }

    public function add()
    {
        $diseases = DiseasesModel::get();
        return view('project.clients.add',['diseases'=>$diseases]);
    }

    public function create(Request $request)
    {
        $data = new ClientsModel();
        $data->name = $request->name;
        $data->user_status = 'new';
        $data->phone = $request->phone;
        $data->dob = $request->dob;
        $data->city = $request->city;
        $data->notes = $request->notes;
        $data->medicines = $request->medicines;
        $data->sensitive = $request->sensitive;
        if($request->filled('diseases')){
            $data->diseases = json_encode($request->diseases);
        }
        if ($data->save()) {
            return redirect()->route('clients.index')->with(['success'=>'تم اضافة العميل بنجاح']);
        }
    }

    public function details($client_id){
        $cleint = ClientsModel::where('id',$client_id)->first();
        $cleint->debt = CustomerDebtModel::where('client_id',$client_id)->sum('value') ?? '';
        $readings = ReadingUsersModel::where('user_id', $client_id)
        ->orderBy('created_at', 'asc')
        ->get();
        $firstVisit = $readings->first();
        $previousVisit = $readings->slice(-2, 1)->first();
        $currentVisit = $readings->last(); // الزيارة الحالية

        $programs = UsersProgramModel::where('client_id',$client_id)->limit(8)->get();
        return view('project.clients.details',['client'=>$cleint , 'readings'=>$readings , 'firstVisit'=>$firstVisit , 'previousVisit'=>$previousVisit , 'currentVisit'=>$currentVisit , 'programs'=>$programs]);
    }

    public function edit($id)
    {
        $diseases = DiseasesModel::get();
        $client = ClientsModel::where('id',$id)->first();
        return view('project.clients.edit',['client'=>$client , 'diseases'=>$diseases]);
    }

    public function update(Request $request)
    {
        $data = ClientsModel::where('id',$request->user_id)->first();
        $data->name = $request->name;
        // $data->user_status = 'active';
        $data->phone = $request->phone;
        $data->dob = $request->dob;
        $data->city = $request->city;
        $data->notes = $request->notes;
        $data->medicines = $request->medicines;
        $data->sensitive = $request->sensitive;
        if($request->filled('diseases')){
            $data->diseases = json_encode($request->diseases);
        }
        if ($data->save()) {
            return redirect()->route('clients.details',['client_id'=>$request->user_id])->with(['success'=>'تم تعديل العميل بنجاح']);
        }
    }

    public function list_clients_ajax(Request $request){
        $data = ClientsModel::query();
        $data->orderBy('id','desc');
        if ($request->filled('name')){
            $data->where('name','like','%'.$request->name.'%');
        }
        if ($request->filled('phone')){
            $data->where('phone','like','%'.$request->phone.'%');
        }
        $data = $data->get();
        foreach ($data as $key){
            $key->debt = CustomerDebtModel::where('client_id',$key->id)->sum('value');
        }
        return response()->json([
            'status' => 'success',
            'view' => view('project.clients.ajax.client_table_ajax',['data'=>$data])->render()
        ]);
    }

    public function add_subscription_for_client_index()
    {
        return view('project.subscriptions.add_subscription_for_client');
    }

    public function add_freezing_subscription(Request $request)
    {
        $client = ClientsModel::where('id', $request->client_id)->first();
    
        if (!$client) {
            return response()->json(['message' => 'Client not found'], 404);
        }
    
        if (
            !is_null($client->start_freezing_date) &&
            !is_null($client->end_freezing_date) &&
            Carbon::now()->between($client->start_freezing_date, $client->end_freezing_date)
        ) {
            return redirect()->route('clients.index')->with(['fail' => 'العميل لديه بالفعل اشتراك مجمد حاليًا']);
        }
    
        $endSubscription = Carbon::parse($client->end_subscription);
        $today = Carbon::today();
    
        // التحقق من أن الاشتراك لا يزال ساريًا
        if ($endSubscription->isPast()) {
            return redirect()->route('clients.index')->with(['fail' => 'لقد انتهى اشتراك هذا المستخدم']);
        }
    
        $remainingDays = $today->diffInDays($endSubscription);
    
        $startFreezingDate = Carbon::parse($request->start_freezing_date);
        $endFreezingDate = Carbon::parse($request->end_freezing_date);
    
        if (!$startFreezingDate->isToday() && !$startFreezingDate->isFuture()) {
            return redirect()->route('clients.index')->with(['fail' => 'تاريخ بدء التجميد يجب أن يكون اليوم أو في المستقبل']);
        }
    
        if (!$endFreezingDate->greaterThan($startFreezingDate)) {
            return redirect()->route('clients.index')->with(['fail' => 'تاريخ انتهاء التجميد يجب أن يكون بعد تاريخ بدء التجميد']);
        }
    
        // تحديث تواريخ التجميد
        $client->start_freezing_date = $startFreezingDate;
        $client->end_freezing_date = $endFreezingDate;
    
        // تحديث نهاية الاشتراك بمدة الأيام المتبقية بعد نهاية التجميد
        $client->end_subscription = $endFreezingDate->copy()->addDays($remainingDays);
    
        if ($client->save()) {
            return redirect()->route('clients.index')->with([
                'success' => "تم تجميد الاشتراك بنجاح. تاريخ نهاية الاشتراك الجديد: {$client->end_subscription->format('Y-m-d')}"
            ]);
        } else {
            return redirect()->route('clients.index')->with(['fail' => 'حدث خطأ أثناء تحديث بيانات التجميد']);
        }
    }
    public function delete($clinet_id){
        $data = ClientsModel::where('id',$clinet_id)->first();
        if ($data->delete()){
            return redirect()->route('clients.index')->with(['success'=>'تم حذف العميل بنجاح']);
        }
    }
}
