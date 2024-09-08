<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\TraningModel as TrainingModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class TrainingController extends Controller
{
    //
    public function training()
    {
        //
        $role = TrainingModel::all();
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Users Role"]
        ];
        return view('admin.role.view-training', compact('breadcrumbs', 'role'));
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
        return view('admin.role.edit-product', compact('breadcrumbs', 'role', 'data'));
        // return view('/content/forms/form-layout', [
        //     'breadcrumbs' => $breadcrumbs
        // ]);
    }
    //
    public function trainingadd(Request $request)
    {
        // return $request;
        $validatedData = Validator::make($request->all(), [
            'name' => 'required|string|unique:roles,name',
        ]);
        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()->all()]);
        }
        //
        if ($file = $request->file('pdf')) {
            // AzureCodeStart
            // $mytime = Carbon::now();
            // $ext =  $mytime->toDateTimeString();
            // $image2 = $ext . '-' . $file[$key]->getClientOriginalName();
            $image2 = file_get_contents($file);
            $originalFileName = time() . $file->getClientOriginalName();
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

            $file->move('documents', $name);
            $input['path'] = $name;
            // LocalStorageEnd
        }
        else{
            $name = 'default.pdf';
        }
        //

        TrainingModel::create(
            [
                'page_name' => $request->name,
                'description' => $request->TrainingDesc,
                'docs_url' => $name,
            ]
        );
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
    // Form Layouts
    public function page(Request $request){
        // return $request->id;
        //
        $role = TrainingModel::findorfail($request->id);
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Users Role"]
        ];
        return view('admin.role.page-training', compact('breadcrumbs', 'role'));
    }
    //
}
