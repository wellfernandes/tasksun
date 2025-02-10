<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Users",
 *     description="Operações relacionadas a usuários"
 * )
 */
class UserController extends Controller{
   /**
     * @OA\PathItem(
     *     path="/api/users",
     *     @OA\Get(
     *         operationId="getUsers",
     *         tags={"Users"},
     *         summary="Listar todos os usuários",
     *         @OA\Response(
     *             response=200,
     *             description="Lista de usuários",
     *             @OA\JsonContent(
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="id", type="integer"),
     *                     @OA\Property(property="name", type="string"),
     *                     @OA\Property(property="email", type="string"),
     *                     @OA\Property(property="created_at", type="string", format="date-time"),
     *                     @OA\Property(property="updated_at", type="string", format="date-time")
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Post(
     *         operationId="createUser",
     *         tags={"Users"},
     *         summary="Criar um novo usuário",
     *         @OA\RequestBody(
     *             required=true,
     *             @OA\JsonContent(
     *                 type="object",
     *                 required={"name", "email", "password", "password_confirmation"},
     *                 @OA\Property(property="name", type="string", example="João Silva"),
     *                 @OA\Property(property="email", type="string", format="email", example="joao@example.com"),
     *                 @OA\Property(property="password", type="string", format="password", example="senha123"),
     *                 @OA\Property(property="password_confirmation", type="string", format="password", example="senha123")
     *             )
     *         ),
     *         @OA\Response(
     *             response=201,
     *             description="Usuário criado com sucesso",
     *             @OA\JsonContent(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer"),
     *                 @OA\Property(property="name", type="string"),
     *                 @OA\Property(property="email", type="string"),
     *                 @OA\Property(property="created_at", type="string", format="date-time"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time")
     *             )
     *         ),
     *         @OA\Response(
     *             response=400,
     *             description="Erro de validação"
     *         )
     *     )
     * )
     */
    public function index(){
        return User::all();
    }

    /**
     * @OA\PathItem(
     *     path="/api/users/{id}",
     *     @OA\Get(
     *         operationId="getUserById",
     *         tags={"Users"},
     *         summary="Obter um usuário por ID",
     *         @OA\Parameter(
     *             name="id",
     *             in="path",
     *             required=true,
     *             @OA\Schema(type="integer")
     *         ),
     *         @OA\Response(
     *             response=200,
     *             description="Usuário encontrado",
     *             @OA\JsonContent(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer"),
     *                 @OA\Property(property="name", type="string"),
     *                 @OA\Property(property="email", type="string"),
     *                 @OA\Property(property="created_at", type="string", format="date-time"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time")
     *             )
     *         ),
     *         @OA\Response(
     *             response=404,
     *             description="Usuário não encontrado"
     *         )
     *     ),
     *     @OA\Delete(
     *         operationId="deleteUser",
     *         tags={"Users"},
     *         summary="Deletar um usuário",
     *         @OA\Parameter(
     *             name="id",
     *             in="path",
     *             required=true,
     *             @OA\Schema(type="integer")
     *         ),
     *         @OA\Response(
     *             response=204,
     *             description="Usuário deletado com sucesso"
     *         ),
     *         @OA\Response(
     *             response=404,
     *             description="Usuário não encontrado"
     *         )
     *     )
     * )
     */
    public function show(User $user){
        return response()->json($user);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return response()->json($user, 201);
    }

    /**
     * @OA\Put(
     *     path="/api/users/{id}",
     *     operationId="updateUser",
     *     tags={"Users"},
     *     summary="Atualizar um usuário",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="name", type="string", example="João Silva Atualizado"),
     *             @OA\Property(property="email", type="string", format="email", example="joao_atualizado@example.com")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Usuário atualizado com sucesso",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer"),
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="email", type="string"),
     *             @OA\Property(property="created_at", type="string", format="date-time"),
     *             @OA\Property(property="updated_at", type="string", format="date-time")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Usuário não encontrado"
     *     )
     * )
     */
    public function update(Request $request, User $user){
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update($request->all());
        return response()->json($user);
    }

    public function destroy(User $user){
        $user->delete();
        return response()->noContent();
    }
}