<?php

namespace App\Http\Controllers;

use App\Models\agenttls;
use App\Models\call_center;
use App\Models\lead_sale;
use App\Models\MonthlyAch;
use App\Models\plan;
use App\Models\WhatsAppMnpBank;
use App\Models\product;
use App\Models\User;
use App\Models\users_docs;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;



class AdminController extends Controller
{
    //
    // Form Layouts
    public function product()
    {
        //
        $role = product::all();
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Users Role"]
        ];
        return view('admin.role.view-product',compact('breadcrumbs','role'));
        // return view('/content/forms/form-layout', [
        //     'breadcrumbs' => $breadcrumbs
        // ]);
    }
    //
    public function product_edit(Request $request)
    {
        //
        $data = product::findorfail($request->id);
        $role = product::all();
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Users Role"]
        ];
        return view('admin.role.edit-product',compact('breadcrumbs','role','data'));
        // return view('/content/forms/form-layout', [
        //     'breadcrumbs' => $breadcrumbs
        // ]);
    }
    //
    public function productadd(Request $request)
    {
        // return $request;
        $validatedData = Validator::make($request->all(), [
            'name' => 'required|string|unique:roles,name',
        ]);
        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()->all()]);
        }

        product::create(['name' => $request->name]);
        return response()->json(['success' => 'Added new records, please wait meanwhile we are redirecting you....!!!']);
    }
    public function productedit(Request $request)
    {
        // return $request;
        $validatedData = Validator::make($request->all(), [
            'name' => 'required|string|unique:roles,name',
        ]);
        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()->all()]);
        }
        $product = product::findorfail($request->id);
        $product->name = $request->name;
        $product->status = $request->status;
        $product->save();

        // product::create(['name' => $request->name]);
        return response()->json(['success' => 'Added new records, please wait meanwhile we are redirecting you....!!!']);
    }
    //
    // Form Layouts
    public function role()
    {
        //
        $role = Role::all();
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Users Role"]
        ];
        return view('admin.role.view-role',compact('breadcrumbs','role'));
        // return view('/content/forms/form-layout', [
        //     'breadcrumbs' => $breadcrumbs
        // ]);
    }
    //
    public function roleadd(Request $request){
        // return $request;
        $validatedData = Validator::make($request->all(), [
            'name' => 'required|string|unique:roles,name',
        ]);
        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()->all()]);
        }

        Role::create(['name' => $request->name]);
        return response()->json(['success' => 'Added new records, please wait meanwhile we are redirecting you....!!!']);
    }
    //
    // Form Layouts
    public function users()
    {
        //
       if(auth()->user()->role == 'MainAdmin'){

            $users = User::withTrashed()
                // ->where('role', '!=','Customer')
                // ->whereIn('users.role', ['NumberAdmin', 'Sale'])
                // ->where('jobtype','target')
                ->get();
        }
        else{
            return 403;
        }

        // $users = User::all();
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Users"]
        ];
        $role = Role::all();
        $tl = User::where('role', 'TeamLeader')->get();

        $call_center = call_center::where('status',1)->get();
        return view('admin.users.view-users', compact('breadcrumbs','call_center','role','users','tl'));
        // return view('/content/forms/form-layout', [
        //     'breadcrumbs' => $breadcrumbs
        // ]);
    }
    //
    public function DataEntryLog()
    {
        // //
        // if(auth()->user()->role == 'Manager'){

        //     $users = User::withTrashed()
        //         // ->where('role', '!=','Customer')
        //         // ->whereIn('users.role', ['NumberAdmin', 'Sale'])
        //         // ->where('jobtype','target')
        //         ->where('agent_code',auth()->user()->agent_code)
        //         ->get();
        // }else{

        //     $users = User::withTrashed()
        //         // ->where('role', '!=','Customer')
        //         // ->whereIn('users.role', ['NumberAdmin', 'Sale'])
        //         // ->where('jobtype','target')
        //         ->get();
        // }

        // $users = User::all();
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Users"]
        ];
        // $role = Role::all();
        $users = User::where('role', 'DataEntry')->get();

        $call_center = call_center::where('status',1)->get();
        return view('admin.users.view-data-entry-log', compact('breadcrumbs','users'));
        // return view('/content/forms/form-layout', [
        //     'breadcrumbs' => $breadcrumbs
        // ]);
    }
    //
    // Form Layouts
    public function addusers()
    {
        //


        // $users = User::all();
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Users"]
        ];
        $role = Role::all();
        $tl = User::where('role', 'TeamLeader')->get();

        $call_center = call_center::where('status',1)->get();
        return view('admin.users.add-users', compact('breadcrumbs','call_center','role','tl'));
        // return view('/content/forms/form-layout', [
        //     'breadcrumbs' => $breadcrumbs
        // ]);
    }
    //
    public function users_edit(Request $request)
    {
        //
        $data = User::findorfail($request->id);
        $tl = User::where('role','TeamLeader')->get();
        // $call_center =
        $role = Role::all();
        $call_center = call_center::where('status', 1)->get();
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Edit Users"]
        ];
        return view('admin.role.edit-users', compact('breadcrumbs', 'role', 'data', 'call_center','tl'));
        // return view('/content/forms/form-layout', [
        //     'breadcrumbs' => $breadcrumbs
        // ]);
    }
    //
    public function commitment_add(Request $request)
    {
        //
        $data = User::findorfail($request->id);
        $tl = User::where('role','TeamLeader')->get();
        // $call_center =
        $role = Role::all();
        $call_center = call_center::where('status', 1)->get();
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Agent Commitment"]
        ];
        return view('admin.role.commitment-users', compact('breadcrumbs', 'role', 'data', 'call_center','tl'));
        // return view('/content/forms/form-layout', [
        //     'breadcrumbs' => $breadcrumbs
        // ]);
    }
    //
    public function usersadd(Request $request)
    {
        // return $request;
        // $validatedData = Validator::make($request->all(), [
        //     'name' => 'required|string|unique:roles,name',
        // ]);
        // if ($validatedData->fails()) {
        //     return response()->json(['error' => $validatedData->errors()->all()]);
        // }

        $validatedData = Validator::make($request->all(), [ // <---
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required'],
            'call_center' => ['required'],
            'cnic_number' => ['required'],
            'phone' => ['required'],
            'jobtype' => ['required'],
            'teamleader' => ['required']
            // 'password' => 'required',
        ]);
        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()->all()]);
        }
        // return implode(',', $request->multi_agentcode);
        // return $request->role;
        $data =   User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'agent_code' => $request->call_center,
            'role' => $request->role,
            'password' => Hash::make($request['password']),
            'sl' => $request->password,
            'phone' => $request->phone,
            'cnic_number' => $request->cnic_number,
            'jobtype' => $request->jobtype,
            'teamleader' => $request->teamleader,
        ]);
        $data->assignRole($request->role);

        $tldoor = agenttls::create([
            'userid' => $data->id,
            'tlid' => $data->teamleader,
        ]);
        // if (!empty($request->permissions)) {

        //     foreach ($request->permissions as $key => $value) {
        //         # code...
        //         // auth()->user()->givePermissionTo('manage postpaid');
        //         $data->givePermissionTo($value);
        //         // return $value;
        //     }
        // }
        // return "Nice";
        // product::create(['name' => $request->name]);
        return response()->json(['success' => 'Added new records, please wait meanwhile we are redirecting you....!!!']);
    }
    //
    public function view_commitment(Request $request){
        // $call_center =
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Agent Commitment"]
        ];
        $data = User::select('users.name','monthly_aches.commitment','monthly_aches.week','monthly_aches.status','users.teamleader')
        ->Join(
            'monthly_aches','monthly_aches.userid','users.id'
        )
        ->get();
        return view('admin.users.view-commitment', compact('breadcrumbs', 'data'));
        // ->where('')
    }
    //
    public function commitment_update(Request $request){
        // return "szom;";

        $mmm = MonthlyAch::where('week', $request->week)
        ->where('userid',$request->id)
        ->whereMonth('created_at',Carbon::now()->month)->first();
        if ($mmm) {
            return response()->json(['error' => ['Documents' => ['Weekly Already Submitted.']]], 200);
        }
        else{
            $d = MonthlyAch::create([
                'userid' => $request->id,
                'week' => $request->week,
                'commitment' => $request->commitment,
                'status' => $request->status,
            ]);
        }
    }
    public function usersedit(Request $request)
    {
        if ($file = $request->file('oath_form')) {
            //convert image to base64
            $image = base64_encode(file_get_contents($request->file('oath_form')));
            $image2 = file_get_contents($request->file('oath_form'));
            // AzureCodeStart
            $originalFileName = time() . $file->getClientOriginalName();
            $multi_filePath = 'user-cnic' . '/' . $originalFileName;
            \Storage::disk('azure')->put($multi_filePath, $image2);
            // AzureCodeEnd
            //prepare request
            $mytime = Carbon::now();
            $ext =  $mytime->toDateTimeString();
            // $name = $ext . '-' . $file->getClientOriginalName();
            $oath_form = $originalFileName;
            // $file->move('user-cnic', $cnic_front);
        } else {
            $oath_form = $request->oath_form;

            // $oath_form = 'default.png';
        }
        //
        if ($file = $request->file('employment')) {
            //convert image to base64
            $image = base64_encode(file_get_contents($request->file('employment')));
            $image2 = file_get_contents($request->file('employment'));
            // AzureCodeStart
            $originalFileName = time() . $file->getClientOriginalName();
            $multi_filePath = 'user-cnic' . '/' . $originalFileName;
            \Storage::disk('azure')->put($multi_filePath, $image2);
            // AzureCodeEnd
            //prepare request
            $mytime = Carbon::now();
            $ext =  $mytime->toDateTimeString();
            // $name = $ext . '-' . $file->getClientOriginalName();
            $employment = $originalFileName;
            // $file->move('user-cnic', $cnic_front);
        } else {
            // $employment = 'default.png';
            $employment = $request->employment;

        }
        //
        //
        if ($file = $request->file('whatsapp_form')) {
            //convert image to base64
            $image = base64_encode(file_get_contents($request->file('whatsapp_form')));
            $image2 = file_get_contents($request->file('whatsapp_form'));
            // AzureCodeStart
            $originalFileName = time() . $file->getClientOriginalName();
            $multi_filePath = 'user-cnic' . '/' . $originalFileName;
            \Storage::disk('azure')->put($multi_filePath, $image2);
            // AzureCodeEnd
            //prepare request
            $mytime = Carbon::now();
            $ext =  $mytime->toDateTimeString();
            // $name = $ext . '-' . $file->getClientOriginalName();
            $whatsapp_form = $originalFileName;
            // $file->move('user-cnic', $cnic_front);
        } else {
            $whatsapp_form = $request->whatsapp_form;
        }
        //
        //
        if ($file = $request->file('monthly_commitment')) {
            //convert image to base64
            $image = base64_encode(file_get_contents($request->file('monthly_commitment')));
            $image2 = file_get_contents($request->file('monthly_commitment'));
            // AzureCodeStart
            $originalFileName = time() . $file->getClientOriginalName();
            $multi_filePath = 'user-cnic' . '/' . $originalFileName;
            \Storage::disk('azure')->put($multi_filePath, $image2);
            // AzureCodeEnd
            //prepare request
            $mytime = Carbon::now();
            $ext =  $mytime->toDateTimeString();
            // $name = $ext . '-' . $file->getClientOriginalName();
            $monthly_commitment = $originalFileName;
            // $file->move('user-cnic', $cnic_front);
        } else {
            $monthly_commitment = $request->monthly_commitment;
        }
        //
        // return $request;
        $user = user::findorfail($request->id);
        $user->teamleader = $request->teamleader;
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->cnic_number = $request->cnic_number;
        $user->jobtype = $request->jobtype;
        $user->agent_code = $request->call_center;
        $user->extension = $request->extension;
        $user->business_whatsapp = $request->business_whatsapp;
        $user->business_whatsapp_undertaking = $request->business_whatsapp_undertaking;
        $user->monthly_commitment = $monthly_commitment;
        $user->whatsapp_form = $whatsapp_form;
        $user->employment = $employment;
        $user->oath_form = $oath_form;
        $user->save();
        // if()
        // if()
        $td = agenttls::select('tlid')->where('userid',$user->id)->orderBy('id','desc')->first();
        // return $td;
        if($td){

            if(!$td->tlid == $user->teamleader){
                $tldoor = agenttls::create([
                    'userid'=>$user->id,
                    'tlid'=>$user->teamleader,
                ]);
            }
        }
            //

        //

        if (!empty($request->documents)) {
            foreach ($request->documents as $key => $val) {
                // return $request->audio;
                // return $request->file();
                if ($file = $request->file('documents')) {
                    // AzureCodeStart
                    // $image2 = file_get_contents($request->file('documents'));
                    $image2 = file_get_contents($file[$key]);
                    $originalFileName = time() . $file[$key]->getClientOriginalName();
                    $multi_filePath = 'documents' . '/' . $originalFileName;
                    \Storage::disk('azure')->put(
                        $multi_filePath,
                        $image2
                    );
                    // AzureCodeEnd
                    // LocalStorageStart
                    $mytime = Carbon::now();
                    $ext =  $mytime->toDateTimeString();
                    // $name = $ext . '-' . $file[$key]->getClientOriginalName();
                    $name = $originalFileName;

                    // $file[$key]->move('documents', $name);
                    // $input['path'] = $name;
                    // LocalStorageEnd
                }
                //     $data2 = meeting_std::create([
                //         'meeting_id' => $meeting_id,
                //         'meeting_title' => $request->course_title,
                //         'std_id' => $val,
                //         'status' => 1,
                //     ]);
                // } else {
                //     echo "boom";
                // }
                $data = users_docs::create([
                    // 'resource_name' => $request->resource_name,
                    'docs' => $name,
                    'userid' => $user->id,
                    // 'batch_id' => $batch_id,
                ]);
            }
        }
        //
        if ($request->password == '') {
            return 1;
        } else {
            $user = user::findorfail($request->id);
            $user->update([
                'password' => Hash::make($request->password),
                'sl' => $request->password,
            ]);
        }
        //

        return "1";

        if ($file = $request->file('cnic_front')) {
            //convert image to base64
            $image = base64_encode(file_get_contents($request->file('cnic_front')));
            $image2 = file_get_contents($request->file('cnic_front'));
            // AzureCodeStart
            $originalFileName = time() . $file->getClientOriginalName();
            $multi_filePath = 'user-cnic' . '/' . $originalFileName;
            \Storage::disk('azure')->put($multi_filePath, $image2);
            // AzureCodeEnd
            //prepare request
            $mytime = Carbon::now();
            $ext =  $mytime->toDateTimeString();
            // $name = $ext . '-' . $file->getClientOriginalName();
            $cnic_front = $originalFileName;
            $file->move('user-cnic',
                $cnic_front
            );
        } else {
            $cnic_front =  $request->cnic_front_old;
        }
        if ($file = $request->file('img')) {
            //convert image to base64
            $image = base64_encode(file_get_contents($request->file('img')));
            $image2 = file_get_contents($request->file('img'));
            // AzureCodeStart
            $originalFileName = time() . $file->getClientOriginalName();
            $multi_filePath = 'user-cnic' . '/' . $originalFileName;
            \Storage::disk('azure')->put($multi_filePath, $image2);
            // AzureCodeEnd
            //prepare request
            $mytime = Carbon::now();
            $ext =  $mytime->toDateTimeString();
            // $name = $ext . '-' . $file->getClientOriginalName();
            $name = $originalFileName;
            $file->move('user-cnic',
                $name
            );
        } else {
            $name =  $request->img_old;
        }
        if ($file = $request->file('cnic_back')) {
            //convert image to base64
            $image = base64_encode(file_get_contents($request->file('cnic_back')));
            $image2 = file_get_contents($request->file('cnic_back'));
            // AzureCodeStart
            $originalFileName = time() . $file->getClientOriginalName();
            $multi_filePath = 'user-cnic' . '/' . $originalFileName;
            \Storage::disk('azure')->put($multi_filePath, $image2);
            // AzureCodeEnd
            //prepare request
            $mytime = Carbon::now();
            $ext =  $mytime->toDateTimeString();
            // $name = $ext . '-' . $file->getClientOriginalName();
            $cnic_back = $originalFileName;
            $file->move('user-cnic',
                $cnic_back
            );
        } else {
            $cnic_back = $request->cnic_back_old;
        }
        // return  $cnic_front . $cnic_back;
        if ($request->password == '') {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'agent_code' => $request->agent_group,
                'phone' => $request->phone,
                'call_center_ip' => $request->call_center_ip,
                'secondary_ip' => $request->secondary_ip,
                'jobtype' => $request->jobtype,
                'profile' => $name,
                // 'password' => Hash::make($request->password),
                'cnic_front' => $cnic_front,
                'cnic_back' => $cnic_back,
                'emirate' => implode(',', $request->emirates),
                'teamleader' => $request->teamleader,
                'is_mnp' => $request->is_mnp,
                // 'password' => Hash::make($request->password),
            ]);
        } else {
            $user->update([
                'name' => $request->name,
                'agent_code' => $request->agent_group,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'sl' => $request->password,
                'jobtype' => $request->jobtype,
                'profile' => $name,
                'call_center_ip' => $request->call_center_ip,
                'secondary_ip' => $request->secondary_ip,
                'cnic_front' => $cnic_front,
                'cnic_back' => $cnic_back,
                'teamleader' => $request->teamleader,
            ]);
        }
        return response()->json(['success' => 'Added new records, please wait meanwhile we are redirecting you....!!!']);
    }
    //
    public function DeleteUser(Request $request){
        // return $request->id;
        $d = user::withTrashed()->find($request->id);
        if (!is_null($d->deleted_at)) {
            $d->restore();
            // return 1;
            // return
            // notify()->info('User has been succesfully Enable');
        } else {
            $d->delete();
            // return 1;
            // notify()->info('User has been succesfully deleted');
        }
        return redirect(route('users'));

    }
    //
    // Form Layouts
    public function call_center()
    {
        //
        $role = call_center::all();
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Call Center"]
        ];
        return view('admin.role.view-call-center', compact('breadcrumbs', 'role'));
        // return view('/content/forms/form-layout', [
        //     'breadcrumbs' => $breadcrumbs
        // ]);
    }
    //
    public function call_center_edit(Request $request)
    {
        //
        $data = call_center::findorfail($request->id);
        $role = call_center::all();
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Edit Call Center"]
        ];
        return view('admin.role.edit-call-center', compact('breadcrumbs', 'role', 'data'));
        // return view('/content/forms/form-layout', [
        //     'breadcrumbs' => $breadcrumbs
        // ]);
    }
    //
    public function cc_add(Request $request)
    {
        // return $request;
        $validatedData = Validator::make($request->all(), [
            'name' => 'required|string|unique:roles,name',
        ]);
        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()->all()]);
        }

        call_center::create(
            [
                'call_center_name' => $request->name,
                'call_center_code' => $request->call_center_short_code,
                'numbers' => $request->numbers,
                'guest_number' => $request->guest_number,
                'status' => $request->status,
                'call_center_amount' => 0,
            ]
        );
        return response()->json(['success' => 'Added new records, please wait meanwhile we are redirecting you....!!!']);
    }
    public function cc_edit(Request $request)
    {
        // return $request;
        $validatedData = Validator::make($request->all(), [
            'name' => 'required|string|unique:roles,name',
        ]);
        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()->all()]);
        }
        $product = call_center::findorfail($request->id);
        $product->call_center_name = $request->name;
        $product->call_center_code = $request->call_center_short_code;
        $product->numbers = $request->numbers;
        $product->guest_number = $request->guest_number;
        $product->status = $request->status;
        $product->save();

        // product::create(['name' => $request->name]);
        return response()->json(['success' => 'Added new records, please wait meanwhile we are redirecting you....!!!']);
    }
    // // Form Layouts
    public function plans()
    {
        //
        $role = plan::where('status','1')->get();
        // $role = plan::all();
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Users Role"]
        ];
        return view('admin.role.view-plans', compact('breadcrumbs', 'role'));
        // return view('/content/forms/form-layout', [
        //     'breadcrumbs' => $breadcrumbs
        // ]);
    }
    //
    public function plan_edit(Request $request)
    {
        //
        $data = plan::findorfail($request->id);
        $role = plan::all();
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Edit Plans"]
        ];
        return view('admin.role.edit-plan', compact('breadcrumbs', 'role', 'data'));
        // return view('/content/forms/form-layout', [
        //     'breadcrumbs' => $breadcrumbs
        // ]);
    }
    //
    public function planadd(Request $request)
    {
        // return $request;
        $validatedData = Validator::make($request->all(), [
            'plan_name' => 'required|string|unique:plans,plan_name',
            'local_minutes' => 'required',
            'data' => 'required',
            'free_minutes' => 'required',
            'flexible_minutes' => 'required',
            'duration' => 'required',
            'status' => 'required',
            'monthly_payment' => 'required',
            'revenue' => 'required',
            'plan_names_du' => 'required',
            // 'revenue_port' => 'required'
        ]);
        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()->all()]);
        }

        plan::create(
            [
                'plan_name' => $request->plan_name,
                'local_minutes' => $request->local_minutes,
                'flexible_minutes' => $request->flexible_minutes,
                'data' => $request->data,
                'free_minutes' => $request->free_minutes,
                'duration' => $request->duration,
                'status' => $request->status,
                'monthly_payment' => $request->monthly_payment,
                'plan_names_du' => $request->plan_names_du
            ]
        );
        return response()->json(['success' => 'Added new records, please wait meanwhile we are redirecting you....!!!']);
    }
    public function planedit(Request $request)
    {
        // return $request;
        $validatedData = Validator::make($request->all(), [
            'plan_name' => [
                'required',
                Rule::unique('plans')->ignore($request->id),
            ],
            'local_minutes' => 'required',
            'data' => 'required',
            'free_minutes' => 'required',
            'flexible_minutes' => 'required',
            'duration' => 'required',
            'status' => 'required',
            'monthly_payment' => 'required',
            'revenue' => 'required',
            'revenue_port' => 'required',
            'plan_names_du' => 'required'
        ]);
        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()->all()]);
        }
        $product = plan::findorfail($request->id);
        $product->plan_name = $request->plan_name;
        $product->local_minutes = $request->local_minutes;
        $product->data = $request->data;
        $product->free_minutes = $request->free_minutes;
        $product->duration = $request->duration;
        $product->monthly_payment = $request->monthly_payment;
        $product->revenue = $request->revenue;
        $product->revenue_port = $request->revenue_port;
        $product->status = $request->status;
        $product->plan_names_du = $request->plan_names_du;
        $product->save();

        // product::create(['name' => $request->name]);
        return response()->json(['success' => 'Added new records, please wait meanwhile we are redirecting you....!!!']);
    }
    //
    public function checksecretcode(Request $request){
        // return "Zone";
        return view('admin.role.checksecretcode');
    }
    //
    public function checkleadnumber(Request $request){
        // return "Zone";
        return view('admin.role.searchlead');
    }
    //
    public function searchnumber(Request $request){
        // return "zoom";
        $data = [];
        if ($request->has('q')) {
            $search = $request->q;
            // $data = whatsapp
             $data = WhatsAppMnpBank::select('whats_app_mnp_banks_1.number_id as number')
            ->where('number_id', 'LIKE', "%$search%")
            ->get();
            // $data = numberdetail::select('numberdetails.*')
            // ->wherein('channel_type', ['TTF', 'ExpressDial', 'MWH', 'Ideacorp'])
            // ->first();
            // if ($data->region != 'Pak') {
            //     $data = numberdetail::select(DB::raw("CONCAT(number,' ', status, ' ', call_center,' ',passcode,' ',type,' ',channel_type ) as number"))
            //     ->where('number', 'LIKE', "%$search%")
            //     ->wherein('channel_type', ['TTF', 'ExpressDial', 'MWH', 'Ideacorp'])
            //     ->get();
            // } else {
            //     $data = numberdetail::select(DB::raw("CONCAT(number,' ', status, ' ', call_center,' ',passcode,' ',type,' :Region => ',region,' ',channel_type ) as number"))
            //     ->where('number', 'LIKE', "%$search%")
            //     ->wherein('channel_type', ['TTF', 'ExpressDial', 'MWH', 'Ideacorp'])
            //     ->get();
            // }
            // if($data->count() > 0){}
            // $data = numberdetail::select(DB::raw("CONCAT(number,' ', status, ' ', call_center,' ',passcode,' ',type ) as number"))
            //     ->where('number', 'LIKE', "%$search%")
            //     ->wherein('channel_type', ['TTF','ExpressDial','MWH','Ideacorp'])
            //     ->get();
        }
        return response()->json($data);
    }
    //
    public function searchleadnumber(Request $request){
        // return "zoom";
        $data = [];
        if ($request->has('q')) {
            $search = $request->q;
            // $data = whatsapp
            $data = lead_sale::select(\DB::raw("CONCAT(customer_number, ' ' , lead_no, ' ', status_name) as number"))
            ->Join(
                'status_codes',
                'status_codes.status_code',
                '=',
                'lead_sales.status'
            )
            ->where('lead_no', 'LIKE', "%$search%")->get();
            //  $data = lead_sales::select('whats_app_mnp_banks_1.number_id as number')
            // ->where('number_id', 'LIKE', "%$search%")
            // ->get();
            // $data = numberdetail::select('numberdetails.*')
            // ->wherein('channel_type', ['TTF', 'ExpressDial', 'MWH', 'Ideacorp'])
            // ->first();
            // if ($data->region != 'Pak') {
            //     $data = numberdetail::select(DB::raw("CONCAT(number,' ', status, ' ', call_center,' ',passcode,' ',type,' ',channel_type ) as number"))
            //     ->where('number', 'LIKE', "%$search%")
            //     ->wherein('channel_type', ['TTF', 'ExpressDial', 'MWH', 'Ideacorp'])
            //     ->get();
            // } else {
            //     $data = numberdetail::select(DB::raw("CONCAT(number,' ', status, ' ', call_center,' ',passcode,' ',type,' :Region => ',region,' ',channel_type ) as number"))
            //     ->where('number', 'LIKE', "%$search%")
            //     ->wherein('channel_type', ['TTF', 'ExpressDial', 'MWH', 'Ideacorp'])
            //     ->get();
            // }
            // if($data->count() > 0){}
            // $data = numberdetail::select(DB::raw("CONCAT(number,' ', status, ' ', call_center,' ',passcode,' ',type ) as number"))
            //     ->where('number', 'LIKE', "%$search%")
            //     ->wherein('channel_type', ['TTF','ExpressDial','MWH','Ideacorp'])
            //     ->get();
        }
        return response()->json($data);
    }
    //
    public function searchnumberoriginal(Request $request){
        // return $request;
        // return "IM MAGIC";
        $data = WhatsAppMnpBank::select('whats_app_mnp_banks_1.*')
        ->where('number_id',$request->number)
        ->first();
        return view('load_data.secret-data-load',compact('data'));

    }
    //
    public function number_original_lead(Request $request){
        // return $request;
        // return "IM MAGIC";
        $heading = 'Load Lead Number';
        $d = explode(' ',$request->number);
        $data = lead_sale::select('lead_sales.customer_name', 'lead_sales.id', 'lead_sales.email', 'lead_sales.customer_number', 'status_codes.status_name as status', 'home_wifi_plans.name as plan_name', 'lead_sales.lead_no', 'lead_sales.created_at', 'lead_sales.updated_at', 'lead_sales.reff_id', 'lead_sales.work_order_num', 'users.name as agent_name', 'lead_sales.lead_type')
            // ->where('lead_sales.lead_type', '')
            ->LeftJoin(
                'home_wifi_plans',
                'home_wifi_plans.id',
                'lead_sales.plans'
            )
            ->Join(
                'status_codes',
                'status_codes.status_code',
                'lead_sales.status'
            )
            ->Join(
                'users',
                'users.id',
                'lead_sales.saler_id'
            )
            // ->when($status, function ($q) use ($status) {
            //     if ($status == 'ActiveLeads') {
            //         $q->where('lead_sales.status', '1.02');
            //     } elseif ($status == 'InProcessLead') {
            //         $q->whereIn('lead_sales.status', ['1.10', '1.05', '1.07', '1.08']);
            //     } elseif ($status == 'PendingLeads') {
            //         $q->whereIn('lead_sales.status', ['1.01', '1.12']);
            //     } elseif ($status == 'RejectLeads') {
            //         $q->whereIn('lead_sales.status', ['1.15']);
            //     }
            // })
            ->where('lead_sales.lead_no', $d[1])
            // ->where('users.agent_code', auth()->user()->agent_code)
            ->get();
        return view('load_data.lead-data-load', compact('heading', 'data'));

    }

}


