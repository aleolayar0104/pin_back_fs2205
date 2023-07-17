<?php

namespace App\Http\Controllers;

use App\Mail\SendPostNewUsers;
use App\Mail\SendPostNewComments;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use GuzzleHttp;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::get();
        $data = $clients->map(function($client){
            return [
                'id' => $client -> id,
                'nombre' => $client -> nombre,
                'apellido' => $client -> apellido,
                'correo' => $client -> correo,
                'celular' => $client -> celular,
                'mensaje' => $client -> mensaje
            ];
        });

        return response()->json([
            'mensaje' => 'Listado de clientes',
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'correo' => ['required', 'email'],
            'mensaje' => ['required', 'string']
        ]);

        $cliente = Client::where('correo', $request->correo)->first();

        if($cliente)
        {
            $cliente->mensaje = $request->mensaje;
            $cliente->save();

            $details = [
                'nombre' => $cliente['nombre'],
                'apellido' => $cliente['apellido'],
                'correo' => $cliente['correo'],
                'celular' => $cliente['celular'],
                'mensaje' => $request['mensaje']
            ];

            Mail::to('alessandra.reano@urp.edu.pe')->send(new SendPostNewComments($details));
    
            return response()->json([
                'mensaje' => 'El usuario ya existente.',
                'nuevo_mensaje' =>$request['mensaje']
            ]);
        }
        else
        {
            $request->validate([
                'nombre' => ['required', 'max:100'],
                'apellido' => ['required', 'max:200'],
                'correo' => ['required', 'email'],
                'celular' => ['required', 'numeric', 'min:9'],
                'mensaje' => ['required', 'max:800']
            ]);
    
            $client = Client::create([
                'nombre' => $request['nombre'],
                'apellido' => $request['apellido'],
                'correo' => $request['correo'],
                'celular' => $request['celular'],
                'mensaje' => $request['mensaje']
            ]);

            $details = [
                'nombre' => $request['nombre'],
                'apellido' => $request['apellido'],
                'correo' => $request['correo'],
                'celular' => $request['celular'],
                'mensaje' => $request['mensaje']
            ];
            
            Mail::to('alessandra.reano@urp.edu.pe')->send(new SendPostNewUsers($details));
    
            return response()->json([
                'mensaje' => 'La consulta se registro correctamente',
                'cliente' => $client
            ]);
        }
        

        
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $client = Client::findOrFail($id);

        return response()->json([
            'mensaje' => 'Cliente: ',
            'client' => $client
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $client)
    {
        $request->validate([
            'nombre' => ['required', 'max:100'],
            'apellido' => ['required', 'max:200'],
            'celular' => ['required', 'alphanum:ascii'],
            'mensaje' => ['required', 'max:800']
        ]);

        $client = Client::findOrFail($client);
        $client->nombre = $request['nombre'];
        $client->apellido = $request['apellido'];
        $client->celular = $request['celular'];
        $client->mensaje = $request['mensaje'];
        $client->save();
        
        return response()->json([
            'mensaje' => 'Se actualizaron los datos correctamente.',
            'cliente' => $client
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $client = Client::findOrFail($id);
        $client -> delete();

        return response()->json([
            'mensaje' => 'Se elimino datos correctamente'
        ]);
    }
}