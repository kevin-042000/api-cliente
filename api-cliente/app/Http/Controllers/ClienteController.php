<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Http\Requests\ClienteRequest;
use Carbon\Carbon;

class ClienteController extends Controller
{
    public function index()
    {
        // Obtener todos los clientes
        $clientes = Cliente::all();
    
        // Devolver la respuesta en el formato solicitado
        return response()->json([
            'status' => 'success',  // Indica que la operación fue exitosa
            'message' => 'Clientes obtenidos con éxito.',  // Un mensaje amigable para el usuario o el desarrollador
            'data' => $clientes  // Los datos de todos los clientes
        ], 200);  // Código HTTP 200 OK
    }
    
    public function store(ClienteRequest $request)
{
    try {
        // Crea una nueva instancia del modelo Cliente y llena los campos con datos del request
        $cliente = new Cliente;
        $cliente->name = $request->name;
        $cliente->surnames = $request->surnames;
        $cliente->phone_number = $request->phone_number;
        $cliente->email = $request->email;
        $cliente->birthdate = Carbon::createFromFormat('d/m/Y', $request->birthdate)->toDateString();
        $cliente->address = $request->address;
        $cliente->country = $request->country;
        $cliente->province = $request->province;
        $cliente->city = $request->city;
        $cliente->postal_code = $request->postal_code;

        // Guarda el nuevo cliente en la base de datos
        $cliente->save();

        // Devuelve la respuesta en el formato solicitado
        return response()->json([
            'status' => 'success',  // Indica que la operación fue exitosa
            'message' => 'Cliente creado con éxito.',  // Un mensaje amigable para el usuario o el desarrollador
            'data' => $cliente  // Los datos del cliente recién creado
        ], 201);  // Código HTTP 201 Created

    } catch (\Exception $e) {
        // Si ocurre un error, captúralo y devuelve una respuesta de error
        return response()->json([
            'status' => 'error',
            'message' => 'Hubo un error al crear el cliente.',
            'error' => $e->getMessage()
        ], 500);  // Código HTTP 500 Internal Server Error
    }
}




public function show(Cliente $cliente)
{
    // Verifica si el cliente existe (aunque la inyección implícita de modelos de Laravel generalmente se encarga de esto)
    if (!$cliente) {
        return response()->json([
            'status' => 'error',
            'message' => 'Cliente no encontrado.',
        ], 404);  // Código HTTP 404 Not Found
    }

    // Devuelve el cliente solicitado en el formato estándar
    return response()->json([
        'status' => 'success',  // Indica que la operación fue exitosa
        'message' => 'Cliente obtenido con éxito.',  // Un mensaje amigable para el usuario o el desarrollador
        'data' => $cliente  // Los datos del cliente solicitado
    ], 200);  // Código HTTP 200 OK
}


    public function update(ClienteRequest $request, Cliente $cliente)
    {
        try {
            // Actualiza un registro
    
            $cliente->name = $request->name;
            $cliente->surnames = $request->surnames;
            $cliente->phone_number = $request->phone_number;
            $cliente->email = $request->email;
            $cliente->birthdate = Carbon::createFromFormat('d/m/Y', $request->birthdate)->toDateString();
            $cliente->address = $request->address;
            $cliente->country = $request->country;
            $cliente->province = $request->province;
            $cliente->city = $request->city;
            $cliente->postal_code = $request->postal_code;
    
            // Guarda los datos del cliente actualizado en la base de datos
            $cliente->update();
    
            // Devuelve la respuesta en el formato solicitado
            return response()->json([
                'status' => 'success',  // Indica que la operación fue exitosa
                'message' => 'Cliente actualizado con éxito.',  // Un mensaje amigable para el usuario o el desarrollador
                'data' => $cliente  // Los datos del cliente recién creado
            ], 200);  // Código HTTP 201 Created
    
        } catch (\Exception $e) {
            // Si ocurre un error, captúralo y devuelve una respuesta de error
            return response()->json([
                'status' => 'error',
                'message' => 'Hubo un error al actualizar el cliente.',
                'error' => $e->getMessage()
            ], 500);  // Código HTTP 500 Internal Server Error
        }    
    }

    public function destroy($id)
    {
        try {
            $cliente = Cliente::find($id);
    
            if (is_null($cliente)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Cliente no encontrado.',
                ], 404);  // Código HTTP 404 Not Found
            }
    
            $cliente->delete();
    
            return response()->json([
                'status' => 'success',
                'message' => 'Cliente eliminado con éxito.',
            ], 200);  // Código HTTP 200 OK
    
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Hubo un error al eliminar el cliente.',
                'error' => $e->getMessage()
            ], 500);  // Código HTTP 500 Internal Server Error
        }
    }
}
