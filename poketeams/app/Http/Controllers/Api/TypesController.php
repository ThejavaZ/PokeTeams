<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Types;
use Illuminate\Http\Request;

class TypesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Types::where('status','=', 1)->get();

        if($types){
            $list = [];

            foreach($types as $type){
                $object = [
                    'id'=> $type->id,
                    'name'=>$type->name,
                    'message'=>[
                        "code"=>'202',
                        "message"=>'Types'
                    ]
                ];

                array_push($list, $object);
            }

            return response()->json($list);
        }
        else{
            $object = [
                "code"=>"404",
                "message"=> "No info."
            ];
            return response()->json($object);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'boolean|default:1',
        ]);

        $type = Types::create([
            'name' => $data['name'],
            'status' => 1,
        ])->save();

        if ($type) {
            $object = [
                "code"=> "202",
                "message"=>"Type creado correctamente",
                "type" => $type
            ];
            return response()->json($object);
        } else {
            $object = [
                "code"=> "404",
                "message"=>"Type NO creado"
            ];
              return response()->json($object);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $type = Types::where('status', '=', 1)->where('id', '=', $id)->first();

        if($type){
            $object = [
                    'id'=> $type->id,
                    'name'=>$type->name,
                    'message'=>[
                        "code"=>'202',
                        "message"=>'Type'
                    ]
            ];
            return response()->json($object);
        }
        else{
            $object = [
                "error"=> 404,
                "menssage"=>"Type no encontrado"
            ];
            return response()->json($object);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function edit(Request $request, $id)
    {
        $type = Types::where('status', '=', 1)->where('id', '=', $id)->first();
        
        if (!$type) {
            return response()->json(["message" => "Type not found."], 404);
        }
        
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'status'=> 'boolean|default:1'
        ]);
        
        $type->update($data);

        if($type){
            $object = [
                "code"=>"200",
                "mensaje"=>"Type updated successfully."
            ];
            return response()->json([$object, $type]);
        }
        else{
            $object = [
                "code"=>"404",
                "mensaje"=>"Type not updated successfully.."  
            ];
            return response()->json([$object]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $type = Types::where('status', '=', 1)->where('id', '=', $id)->first();        
        if (!$type) {
            $object =[
                "code"=>"404",
                "mensaje"=>"Type not found."
            ];
            return response()->json($object);
        }
        else{
            $type->update(['status' => 0]);
            $object = [
                    "code"=>"200",
                    "mensaje"=>"Type deleted successfully."
            ];

            return response()->json($object);
        }
    }
}