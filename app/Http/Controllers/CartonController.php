<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Carton;
use Carbon\Carbon;
use Validator;
use Illuminate\Http\Response;

class CartonController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index()
    {
        $cartons = Carton::doesntHave('sent_carton')->where('user_id', auth()->id())->with('carton_type')->get();
        return $cartons;
    }
    public function store(Request $request)
    {
       
        $v = Validator::make($request->all(), [
            'barcode' => 'required|regex:/^[0-9]{6,8}$/|unique:cartons',
            'carton_type_id' => 'required',
        ], [
            'barcode.unique' => 'El codigo de cartón ingresado ya existe',
            'barcode.regex' => 'El codigo de cartón tiene un patron incorrecto'
        ]);

        if ($v->fails()){
            return response($v->errors(), 500);
        }else{
            $carton = New Carton;
            $carton->barcode = $request->barcode;
            $carton->carton_type_id = $request->carton_type_id;
            $carton->user_id = auth()->id();
            $carton->site_id = auth()->user()->site_id;
            $carton->created_at = Carbon::now();
            $carton->save();
            $carton->load('carton_type');
    
            return $carton;
        }

    }

    public function update(Request $request, $id)
    {
        $v = Validator::make($request->all(), [
            'barcode' => 'required|unique:cartons|regex:/^[0-9]{6,8}$/',
        ], [
            'barcode.unique' => 'El codigo de cartón ingresado ya existe',
            'barcode.regex' => 'El codigo de cartón tiene un patron incorrecto'
        ]);

        if ($v->fails()){
            return response($v->errors(), 500);
        }else{
            $carton = Carton::find($id);
            $carton->barcode = $request->barcode;
            $carton->updated_at = Carbon::now();
            $carton->save();
            $carton->load('carton_type');
    
            return $carton;
        }

    }

    public function destroy($id)
    {
        $carton = Carton::findOrFail($id);
        $carton->delete();
    }
}
