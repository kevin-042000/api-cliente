<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Http\Requests\ClienteRequest;
use Carbon\Carbon;
use Illuminate\Http\Response; // Importar la clase Response para utilizar códigos HTTP estándar


class ClienteController extends Controller
{
    public function index()
    {
        // Obtener todos los clientes
        $clientes = Cliente::all();

        // Si no hay clientes, devuelve un error 404
        if ($clientes->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No se encontraron clientes.',
                'data' => []
            ], 404); // Código HTTP 404 Not Found
        }
    
        // Si hay clientes, devuélvelos con un código 200
        return response()->json([
            'status' => 'success',
            'message' => 'Clientes obtenidos con éxito.',
            'data' => $clientes
        ], 200); // Código HTTP 200 OK
    }

    public function store(ClienteRequest $request)
    {
        try {
            // Crea una nueva instancia del modelo Cliente y llena los campos
            $cliente = new Cliente;
            // (...)
            $cliente->save();

            // Si todo sale bien, devuelve el cliente creado con un código 201
            return response()->json([
                'status' => 'success',
                'message' => 'Cliente creado con éxito.',
                'data' => $cliente
            ], 201); // Código HTTP 201 Created
    
        } catch (\Exception $e) {
            // Si algo sale mal, captura la excepción y devuelve un mensaje de error con código 500
            return response()->json([
                'status' => 'error',
                'message' => 'Hubo un error al crear el cliente.',
                'error' => $e->getMessage()
            ], 500); // Código HTTP 500 Internal Server Error
        }
    }

    
    public function show(Cliente $cliente)
    {
        // Inyección implícita de modelos. Si no encuentra el cliente, Laravel manejará automáticamente un error 404
        // Si encuentra el cliente, lo devuelve con un código 200
        return response()->json([
            'status' => 'success',
            'message' => 'Cliente obtenido con éxito.',
            'data' => $cliente
        ], 200); // Código HTTP 200 OK
    }

    public function update(ClienteRequest $request, Cliente $cliente)
    {
        try {
            // Actualiza los campos del cliente
            // (...)
            $cliente->update();

            // Si todo sale bien, devuelve el cliente actualizado con un código 200
            return response()->json([
                'status' => 'success',
                'message' => 'Cliente actualizado con éxito.',
                'data' => $cliente
            ], 200); // Código HTTP 200 OK
            
        } catch (\Exception $e) {
            // Si algo sale mal, captura la excepción y devuelve un mensaje de error con código 500
            return response()->json([
                'status' => 'error',
                'message' => 'Hubo un error al actualizar el cliente.',
                'error' => $e->getMessage()
            ], 500); // Código HTTP 500 Internal Server Error
        }
    }


    public function destroy($id)
    {
        try {
            // Busca el cliente por ID
            $cliente = Cliente::find($id);
    
            if (is_null($cliente)) {
                // Si no encuentra el cliente, devuelve un error 404
                return response()->json([
                    'status' => 'error',
                    'message' => 'Cliente no encontrado.'
                ], 404); // Código HTTP 404 Not Found
            }
    
            // Elimina el cliente y devuelve un mensaje de éxito con un código 200
            $cliente->delete();
    
            return response()->json([
                'status' => 'success',
                'message' => 'Cliente eliminado con éxito.'
            ], 200); // Código HTTP 200 OK
    
        } catch (\Exception $e) {
            // Si algo sale mal, captura la excepción y devuelve un mensaje de error con código 500
            return response()->json([
                'status' => 'error',
                'message' => 'Hubo un error al eliminar el cliente.',
                'error' => $e->getMessage()
            ], 500); // Código HTTP 500 Internal Server Error
        }
    }
}
