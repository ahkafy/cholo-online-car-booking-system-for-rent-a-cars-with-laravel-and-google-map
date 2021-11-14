<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Frontend\Booking;
use App\User;

use Illuminate\Http\Request;


use DataTables;
use Validator;


class CompleteController extends Controller
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
          $data = Booking::where('status', 'completed')->get();
          return DataTables::of($data)
                  ->addColumn('action', function($data){
                    $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm disabled">Complete</button>';
                    //  $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                      return $button;
                  })
                  ->editColumn('created_at', function ($data) { return date('F d, Y @ h:i:s a', strtotime($data->created_at) ); })
                  ->editColumn('updated_at', function ($data) { return date('F d, Y @ h:i:s a', strtotime($data->updated_at) ); })
                  ->editColumn('is_active', function ($data) {   if ($data->is_active == 0) return 'Inactive';   if ($data->is_active == 1) return 'Active'; return 'Cancel';})
                  ->editColumn('user_id', function ($data) { return User::where('id', $data->user_id)->first()->name .' - '. User::where('id', $data->user_id)->first()->phone;})


                  ->rawColumns(['action'])
                  ->make(true);
      }
      return view('backend.complete');
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
        $data = Booking::findOrFail($id);
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
          $data = Booking::findOrFail($id);
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
          'ride_id'    =>  'required|exists:rides,id',
          'status'    =>  'required',
      );

      $error = Validator::make($request->all(), $rules);

      if($error->fails())
      {
          return response()->json(['errors' => $error->errors()->all()]);
      }

      $form_data = array(
          'ride_id'        =>  $request->ride_id,
          'status'        =>  $request->status,
      );

      Booking::whereId($request->hidden_id)->update($form_data);

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

    }
}
