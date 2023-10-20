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
        return Cliente::all();
    }

    public function store(ClienteRequest $request)
    {
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

        $cliente->save();

        return $cliente;
    }

    public function show(Cliente $cliente)
    {
        return $cliente;
    }

    public function update(ClienteRequest $request, Cliente $cliente)
    {
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
        $cliente->update();

        return $cliente;        
    }

    public function destroy($id)
    {
        $cliente = Cliente::find($id);

        if(is_null($cliente)){
            return response()->json('No se pudo realizar correctamente la operacion', 404);
        }

        $cliente->delete();
        return response()->noContent();
    }
}
