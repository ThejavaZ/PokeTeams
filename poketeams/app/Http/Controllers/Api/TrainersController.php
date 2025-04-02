<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Trainers;
use Illuminate\Http\Request;

class TrainersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trainers = Trainers::where('status','=', 1)->get();

        if($trainers){
            $list = [];

            foreach($trainers as $trainer){
                $object = [
                    'id'=> $trainer->id,
                    'name'=>$trainer->name,
                    'region'=>$trainer->region,
                    'message'=>[
                        "code"=>'202',
                        "message"=>'Trainers'
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
            'region' => 'required|string|max:255',
            'status' => 'boolean|default:1',
        ]);

        $trainer = Trainers::create([
            'name' => $data['name'],
            'region' => $data['region'],
            'status' => 1,
        ])->save();

        if ($trainer) {
            $object = [
                "code"=> "202",
                "message"=>"Trainer creado correctamente"
            ];
            return response()->json([$object, $trainer]);
        } else {
            $object = [
                "code"=> "404",
                "message"=>"Trainer NO creado"
            ];
              return response()->json($object,);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $trainer = Trainers::where('status', '=', 1)->where('id', '=', $id)->first();

        if($trainer){
            $object = [
                    'id'=> $trainer->id,
                    'name'=>$trainer->name,
                    'region'=>$trainer->region,
                    'message'=>[
                        "code"=>'202',
                        "message"=>'Trainer'
                    ]
            ];
            return response()->json($object);
        }
        else{
            $object = [
                "error"=> 404,
                "menssage"=>"Trainer no encontrado"
            ];
            return response()->json($object);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function edit(Request $request, $id)
    {
        $trainer = Trainers::where('status', '=', 1)->where('id', '=', $id)->first();
        
        if (!$trainer) {
            return response()->json(["message" => "Trainer not found."], 404);
        }
        
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'region' => 'required|string|max:255',
            'status'=> 'boolean|default:1'
        ]);
        
        $trainer->update($data);

        if($trainer){
            $object = [
                "code"=>"200",
                "mensaje"=>"Trainer updated successfully."
            ];
            return response()->json([$object, $trainer]);
        }
        else{
            $object = [
                "code"=>"404",
                "mensaje"=>"Trainer not updated successfully.."  
            ];
            return response()->json([$object]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $trainer = Trainers::where('status', '=', 1)->where('id', '=', $id)->first();        
        if (!$trainer) {
            $object =[
                "code"=>"404",
                "mensaje"=>"Trainer not found."
            ];
            return response()->json($object);
        }
        else{
            $trainer->update(['status' => 0]);
            $object = [
                    "code"=>"200",
                    "mensaje"=>"Trainer deleted successfully."
            ];

            return response()->json([$object,$trainer]);
        }
    }
}