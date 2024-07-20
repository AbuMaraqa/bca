<?php

namespace App\Http\Controllers;

use App\Models\ClientsModel;
use App\Models\CustomerDebtModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CustomerDebtController extends Controller
{
    public function index($client_id){
        $client = ClientsModel::where('id',$client_id)->first();
        $data = CustomerDebtModel::where('client_id',$client_id)->get();
        $total_debt = CustomerDebtModel::where('client_id',$client_id)->sum('value');
        return view('project.clients.customer_debts.index',['client'=>$client,'data'=>$data,'total_debt'=>$total_debt]);
    }

    public function add($client_id)
    {
        $client = ClientsModel::where('id',$client_id)->first();
        return view('project.clients.customer_debts.add', ['client'=>$client]);
    }

    public function create(Request $request)
    {
        $data = new CustomerDebtModel();
        $data->client_id = $request->client_id;
        $data->type = $request->type;
        if ($request->type == 'debtor'){
            $data->value = -($request->value);
        }
        else{
            $data->value = $request->value;
        }
        $data->insert_at = Carbon::now();
        $data->notes = $request->notes;
        if ($data->save()){
            return redirect()->route('customers_debt.index',['client_id'=>$request->client_id])->with(['success'=>'تم اضافة الدين بنجاح']);
        }
    }

    public function delete($id)
    {
        $data = CustomerDebtModel::where('id',$id)->first();
        $client_id = $data->client_id;
        if ($data->delete()){
            return redirect()->route('customers_debt.index',['client_id'=>$client_id])->with(['success'=>'تم حذف الدفعة بنجاح']);
        }
    }
}
