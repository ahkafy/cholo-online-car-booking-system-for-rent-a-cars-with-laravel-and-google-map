<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Owners;
use Illuminate\Http\Request;

use DataTables;
use Validator;

class OwnerController extends Controller
{

    public function __construct(){
      $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      if($request->ajax())
      {
          $data = Owners::latest()->get();
          return DataTables::of($data)
                  ->addColumn('action', function($data){
                      $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Edit</button>';
                      $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                      return $button;
                  })
                  ->editColumn('created_at', function ($data) { return date('F d, Y @ h:i:s a', strtotime($data->created_at) ); })
                  ->editColumn('updated_at', function ($data) { return date('F d, Y @ h:i:s a', strtotime($data->updated_at) ); })
                  ->editColumn('is_active', function ($data) {   if ($data->is_active == 0) return 'Inactive';   if ($data->is_active == 1) return 'Active'; return 'Cancel';
})
                  ->rawColumns(['action'])
                  ->make(true);
      }
      return view('backend.owners');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $rules = array(
          'name'    =>  'required',
          'phone'    =>  'required|unique:owners',
          'present_address'    =>  'required',
          'permanent_address'    =>  'required',
          'nid'    =>  'required|unique:owners',
          'nid_file'    =>  'required',
          'is_active'    =>  'required',
          'photo'    =>  'required',

      );

      $customMessages = [
            'unique' => 'Already exists.',
            'exists' => 'Rider not found',
      ];

      $error = Validator::make($request->all(), $rules, $customMessages);

      if($error->fails())
      {
          return response()->json(['errors' => $error->errors()->all()]);
      }

      $nid_file = $request->file('nid_file');
      $nid_file_new_name = rand() . '.' . $nid_file->getClientOriginalExtension();
      $nid_file->move(public_path('uploads'), $nid_file_new_name);

      $photo = $request->file('photo');
      $photo_new_name = rand() . '.' . $photo->getClientOriginalExtension();
      $photo->move(public_path('uploads'), $photo_new_name);

      $form_data = array(
          'name'        =>  $request->name,
          'phone'        =>  $request->phone,
          'present_address'        =>  $request->present_address,
          'permanent_address'        =>  $request->permanent_address,
          'nid'        =>  $request->nid,
          'nid_file'        =>  $nid_file_new_name,
          'is_active'        =>  $request->is_active,
          'photo'        =>  $photo_new_name,
      );

      Owners::create($form_data);

    $url = "http://66.45.237.70/api.php";
      $id=Owners::where('phone', $request->phone)->first()->id;
      $text="Congratulations. You are registered on cholo app. Your id is $id";
      $data= array(
      'username'=>"ahkafy",
      'password'=>"4C9NKSH6",
      'number'=>"$request->phone",
      'message'=>"$text"
      );

      $ch = curl_init(); // Initialize cURL
      curl_setopt($ch, CURLOPT_URL,$url);
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $smsresult = curl_exec($ch);
      $p = explode("|",$smsresult);
      $sendstatus = $p[0];

      return response()->json(['success' => 'Data Added successfully.']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data = Owners::findOrFail($id);
        return view('view', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      if(request()->ajax())
      {
          $data = Owners::findOrFail($id);
          return response()->json(['result' => $data]);
      }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      $rules = array(
          'name'    =>  'required',
          'phone'    =>  'required|unique:owners',
          'present_address'    =>  'required',
          'permanent_address'    =>  'required',
          'nid'    =>  'required|unique:owners',
          'nid_file'    =>  'required',
          'is_active'    =>  'required',
          'photo'    =>  'required',

      );

      $customMessages = [
            'unique' => 'Already exists.',
            'exists' => 'Rider not found',
      ];

      $error = Validator::make($request->all(), $rules, $customMessages);

      if($error->fails())
      {
          return response()->json(['errors' => $error->errors()->all()]);
      }

      $nid_file = $request->file('nid_file');
      $nid_file_new_name = rand() . '.' . $nid_file->getClientOriginalExtension();
      $nid_file->move(public_path('uploads'), $nid_file_new_name);

      $photo = $request->file('photo');
      $photo_new_name = rand() . '.' . $photo->getClientOriginalExtension();
      $photo->move(public_path('uploads'), $photo_new_name);

      $form_data = array(
          'name'        =>  $request->name,
          'phone'        =>  $request->phone,
          'present_address'        =>  $request->present_address,
          'permanent_address'        =>  $request->permanent_address,
          'nid'        =>  $request->nid,
          'nid_file'        =>  $nid_file_new_name,
          'is_active'        =>  $request->is_active,
          'photo'        =>  $photo_new_name,
      );

      Owners::whereId($request->hidden_id)->update($form_data);

      return response()->json(['success' => 'Data is successfully updated']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $data = Owners::findOrFail($id);
      $data->delete();
    }
}
