<?php

namespace App\Http\Controllers;

use App\Models\country_phone_code;
use App\Models\emirate;
use App\Models\lead_sale;
use App\Models\plan;
use App\Models\remark;
use Illuminate\Http\Request;

class DesignerController extends Controller
{
    //
    public function all_lead_designer(Request $request){
        // $role =
        $data = lead_sale::select('lead_sales.customer_name', 'lead_sales.id', 'lead_sales.email', 'lead_sales.customer_number', 'status_codes.status_name as status', 'plans.plan_name', 'lead_sales.lead_no')
        ->whereIn('lead_type', ['MNP', 'P2P'])
        // ->where('lead_type','HomeWifi')
        ->Join(
            'plans',
            'plans.id',
            'lead_sales.plans'
        )
        ->Join(
            'status_codes',
            'status_codes.status_code',
            'lead_sales.status'
        )
        ->where('lead_sales.status','1.13')
        ->get();

        return view('admin.lead.all-designer-lead',compact('data'));

    }
    //
    //
    public function DesignerLead(Request $request){
        // $role =
        $data = lead_sale::select('lead_sales.customer_name', 'lead_sales.id', 'lead_sales.email', 'lead_sales.customer_number', 'status_codes.status_name as status', 'plans.plan_name', 'lead_sales.lead_no','lead_sales.emirate_id','lead_sales.nationality','lead_sales.dob','lead_sales.emirate_expiry','lead_sales.emirate', 'lead_sales.additional_docs_name','lead_sales.front_id','lead_sales.back_id')
        // ->whereIn('lead_type', ['MNP', 'P2P'])
        // ->where('lead_type','HomeWifi')
        ->Join(
            'plans',
            'plans.id',
            'lead_sales.plans'
        )
        ->Join(
            'status_codes',
            'status_codes.status_code',
            'lead_sales.status'
        )
        // ->where('lead_sales.status','1.13')
        ->where('lead_sales.id',$request->id)
        ->first();
        if(empty($data)){
            return redirect(route('home'));
        }
        $plan = plan::where('status', '1')->get();
        $country = country_phone_code::select('name')->get();
        $emirate = emirate::select('name')->where('status', 1)->get();
        // $plan = \App\Models\plan
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"
            ], ['link' => "javascript:void(0)", 'name' => "New Lead Form"]
        ];
        $remarks = remark::where('lead_no', $request->id)->get();


        return view('admin.lead.view-designer-lead',compact('data','plan','country','emirate','breadcrumbs', 'remarks'));
    }
    //
}
