<?php

namespace App\Http\Controllers;

use App\Models\ClientModel;
use App\Models\ClientsModel;
use App\Models\SubscriptionClientModel;
use App\Models\SubscriptionModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubscriptionsClientController extends Controller
{
    public function index($id)
    {
        $client = ClientsModel::where('id',$id)->first();
        $data = SubscriptionClientModel::where('client_id',$id)->with('subscription')->get();
        return view('project.clients.subscriptions.index', ['data'=>$data , 'client'=>$client]);
    }

    public function add($client_id)
    {
        $client = ClientsModel::find($client_id);
        $subscriptions = SubscriptionModel::get();
        return view('project.clients.subscriptions.add_subscription_for_client', ['client'=>$client , 'subscriptions'=>$subscriptions]);
    }

    public function create(Request $request)
    {
        $client = ClientsModel::where('id',$request->client_id)->first();
        $subscription = SubscriptionModel::where('id',$request->subscriptions_id)->first();
        if ($client->end_subscription == null){
            $client->end_subscription = Carbon::parse($client->end_subscription)->addDay($subscription->duration);
            $client->user_status = 'old';
            $client->save();
        }
        else{
            $client->end_subscription = Carbon::parse($client->end_subscription)->addDay($subscription->duration);
            $client->save();
        }
        $data = new SubscriptionClientModel();
        $data->client_id = $request->client_id;
        $data->subscriptions_id = $request->subscriptions_id;
        $data->insert_at = Carbon::now();
        $data->price = $subscription->price;
        $data->duration = $subscription->duration;
        $data->status = 'active';
        if($data->save()){
            return redirect()->route('clients.subscriptions.index',['client_id'=>$request->client_id])->with(['success'=>'تم اضافة الاشتراك بنجاح']);
        }
    }
}
