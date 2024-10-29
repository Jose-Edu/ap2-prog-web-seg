<?php

namespace App\Http\Controllers;

use App\Models\Vendedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VendedorController extends Controller
{
    public function index() // Listar todos
    {
        $vendedores = Vendedor::all();
        return response()->json([
            'status' => true,
            'message' => 'Vendedores encontrados com sucesso!',
            'data' => $vendedores
        ], 200);
    }

    public function show($id) // Listar por id
    {
        $vendedor = Vendedor::findOrFail($id);
        return response()->json([
            'status' => true,
            'message' => 'Vendedor encontrado com sucesso!',
            'data' => $vendedor
        ], 200);
    }

    public function store(Request $request) // Criar
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:200',
            'cpf' => 'required|string|max:15',
            'ano_de_nascimento' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $vendedor = Vendedor::create($request->all());
        return response()->json([
            'status' => true,
            'message' => 'Vendedor criado com sucesso!',
            'data' => $vendedor
        ], 201);
    }

    public function update(Request $request, $id) // Editar
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:200',
            'cpf' => 'required|string|max:15',
            'ano_de_nascimento' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $vendedor = Vendedor::findOrFail($id);
        $vendedor->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Vendedor atualizado com sucesso!',
            'data' => $vendedor
        ], 200);
    }

    public function destroy($id) // Remover
    {
        $vendedor = Vendedor::findOrFail($id);
        $vendedor->delete();
        
        return response()->json([
            'status' => true,
            'message' => 'Vendedor deletado com sucesso!'
        ], 204);
    }
}
