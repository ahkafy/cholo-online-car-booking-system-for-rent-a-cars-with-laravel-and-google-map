<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Rides;
use App\Models\Backend\Owners;
use Illuminate\Http\Request;

use DataTables;
use Validator;

class RideController extends Controller
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
          $data = Rides::latest()->get();
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
      return view('backend.rides');
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
          'type'    =>  'required',
          'owner'    =>  'required|exists:owners,id',
          'rider'    =>  'required|exists:riders,id',
          'registration'    =>  'required|unique:rides',
          'registration_expiry_date'    =>  'required',
          'registration_file'    =>  'required|image|max:2048',
          'tax_token'    =>  'required|unique:rides',
          'tax_token_expiry_date'    =>  'required',
          'tax_token_file'    =>  'required|image|max:2048',
          'insurance'    =>  'required|unique:rides',
          'insurance_expiry_date'    =>  'required',
          'insurance_file'    =>  'required|image|max:2048',
          'fitness'    =>  'required|unique:rides',
          'fitness_expiry_date'    =>  'required',
          'fitness_file'    =>  'required|image|max:2048',
          'is_active'    =>  'required',
          'photo_file'    =>  'required',
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


      $registration_file = $request->file('registration_file');
      $registration_file_new_name = rand() . '.' . $registration_file->getClientOriginalExtension();
      $registration_file->move(public_path('uploads'), $registration_file_new_name);

      $tax_token_file = $request->file('tax_token_file');
      $tax_token_file_new_name = rand() . '.' . $tax_token_file->getClientOriginalExtension();
      $tax_token_file->move(public_path('uploads'), $tax_token_file_new_name);

      $insurance_file = $request->file('insurance_file');
      $insurance_file_new_name = rand() . '.' . $insurance_file->getClientOriginalExtension();
      $insurance_file->move(public_path('uploads'), $insurance_file_new_name);

      $fitness_file = $request->file('fitness_file');
      $fitness_file_new_name = rand() . '.' . $fitness_file->getClientOriginalExtension();
      $fitness_file->move(public_path('uploads'), $fitness_file_new_name);

      $photo_file = $request->file('photo_file');
      $photo_file_new_name = rand() . '.' . $photo_file->getClientOriginalExtension();
      $photo_file->move(public_path('uploads'), $photo_file_new_name);

      $form_data = array(
          'type'        =>  $request->type,
          'owner'        =>  $request->owner,
          'rider'        =>  $request->rider,
          'registration'        =>  $request->registration,
          'registration_expiry_date'        =>  $request->registration_expiry_date,
          'registration_file'        =>  $registration_file_new_name,

          'tax_token'        =>  $request->tax_token,
          'tax_token_expiry_date'        =>  $request->tax_token_expiry_date,
          'tax_token_file'        =>  $tax_token_file_new_name,

          'insurance'        =>  $request->insurance,
          'insurance_expiry_date'        =>  $request->registration_expiry_date,
          'insurance_file'        =>  $insurance_file_new_name,

          'fitness'        =>  $request->fitness,
          'fitness_expiry_date'        =>  $request->fitness_expiry_date,
          'fitness_file'        =>  $fitness_file_new_name,

          'is_active'        =>  $request->is_active,
          'photo'        =>  $photo_file_new_name,
      );

      Rides::create($form_data);

      return response()->json(['success' => 'Data Added successfully.']);

      $url = "http://66.45.237.70/api.php";
      $phone=Owners::where('id', $request->owner)->first()->phone;
      $text="Congratulations. Your vehicle $request->registration is registered on Cholo App.";
      $data= array(
      'username'=>"ahkafy",
      'password'=>"4C9NKSH6",
      'number'=>"$phone",
      'message'=>"$text"
      );

      $ch = curl_init(); // Initialize cURL
      curl_setopt($ch, CURLOPT_URL,$url);
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $smsresult = curl_exec($ch);
      $p = explode("|",$smsresult);
      $sendstatus = $p[0];

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
        $data = Rides::findOrFail($id);
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
          $data = Rides::findOrFail($id);
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
          'type'    =>  'required',
          'owner'    =>  'required|exists:owners,id',
          'rider'    =>  'required|exists:riders,id',
          'registration'    =>  'required',
          'registration_expiry_date'    =>  'required',
          'registration_file'    =>  'required',
          'tax_token'    =>  'required',
          'tax_token_expiry_date'    =>  'required',
          'tax_token_file'    =>  'required',
          'insurance'    =>  'required',
          'insurance_expiry_date'    =>  'required',
          'insurance_file'    =>  'required',
          'firness'    =>  'required',
          'fitness_expiry_date'    =>  'required',
          'fitness_file'    =>  'required',
          'is_active'    =>  'required',
          'photo_file'    =>  'required',
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


      $registration_file = $request->file('registration_file');
      $registration_file_new_name = rand() . '.' . $registration_file->getClientOriginalExtension();
      $registration_file->move(public_path('uploads'), $registration_file_new_name);

      $tax_token_file = $request->file('tax_token_file');
      $tax_token_file_new_name = rand() . '.' . $tax_token_file->getClientOriginalExtension();
      $tax_token_file->move(public_path('uploads'), $tax_token_file_new_name);

      $insurance_file = $request->file('insurance_file');
      $insurance_file_new_name = rand() . '.' . $insurance_file->getClientOriginalExtension();
      $insurance_file->move(public_path('uploads'), $insurance_file_new_name);

      $fitness_file = $request->file('fitness_file');
      $fitness_file_new_name = rand() . '.' . $fitness_file->getClientOriginalExtension();
      $fitness_file->move(public_path('uploads'), $fitness_file_new_name);

      $photo_file = $request->file('photo_file');
      $photo_file_new_name = rand() . '.' . $photo_file->getClientOriginalExtension();
      $photo_file->move(public_path('uploads'), $photo_file_new_name);

      $form_data = array(
          'type'        =>  $request->type,
          'owner'        =>  $request->owner,
          'rider'        =>  $request->rider,
          'registration'        =>  $request->registration,
          'registration_expiry_date'        =>  $request->registration_expiry_date,
          'registration_file'        =>  $registration_file_new_name,

          'tax_token'        =>  $request->tax_token,
          'tax_token_expiry_date'        =>  $request->tax_token_expiry_date,
          'tax_token_file'        =>  $tax_token_file_new_name,

          'insurance'        =>  $request->insurance,
          'insurance_expiry_date'        =>  $request->registration_expiry_date,
          'insurance_file'        =>  $insurance_file_new_name,

          'fitness'        =>  $request->fitness,
          'fitness_expiry_date'        =>  $request->fitness_expiry_date,
          'fitness_file'        =>  $fitness_file_new_name,

          'is_active'        =>  $request->is_active,
          'photo'        =>  $photo_file_new_name,
      );

      Rides::whereId($request->hidden_id)->update($form_data);

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
      $data = Rides::findOrFail($id);
      $data->delete();
    }
}
