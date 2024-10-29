<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdutoController extends Controller
{
    public function index() // Listar todos
    {
        $produtos = Produto::all();
        return response()->json([
            'status' => true,
            'message' => 'Produtos encontrados com sucesso!',
            'data' => $produtos
        ], 200);
    }

    public function show($id) // Listar por id
    {
        $produto = Produto::findOrFail($id);
        return response()->json([
            'status' => true,
            'message' => 'Produto encontrado com sucesso!',
            'data' => $produto
        ], 200);
    }

    public function store(Request $request) // Criar
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:200',
            'preco' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $produto = Produto::create($request->all());
        return response()->json([
            'status' => true,
            'message' => 'Produto criado com sucesso!',
            'data' => $produto
        ], 201);
    }

    public function update(Request $request, $id) // Editar
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:200',
            'preco' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $produto = Produto::findOrFail($id);
        $produto->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Produto atualizado com sucesso!',
            'data' => $produto
        ], 200);
    }

    public function destroy($id) // Remover
    {
        $produto = Produto::findOrFail($id);
        $produto->delete();
        
        return response()->json([
            'status' => true,
            'message' => 'Produto deletado com sucesso!'
        ], 204);
    }
}
