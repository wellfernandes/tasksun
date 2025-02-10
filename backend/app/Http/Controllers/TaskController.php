<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Tasks",
 *     description="Operações relacionadas a tarefas"
 * )
 * 
 * @OA\PathItem(
 *     path="/api/tasks",
 *     @OA\Get(
 *         operationId="getTasks",
 *         tags={"Tasks"},
 *         summary="Listar todas as tarefas",
 *         @OA\Response(
 *             response=200,
 *             description="Lista de tarefas",
 *             @OA\JsonContent(
 *                 type="array",
 *                 @OA\Items(
 *                     type="object",
 *                     @OA\Property(property="id", type="integer"),
 *                     @OA\Property(property="title", type="string"),
 *                     @OA\Property(property="description", type="string", nullable=true),
 *                     @OA\Property(property="status", type="string"),
 *                     @OA\Property(property="user_id", type="integer"),
 *                     @OA\Property(property="created_at", type="string", format="date-time"),
 *                     @OA\Property(property="updated_at", type="string", format="date-time")
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Post(
 *         operationId="createTask",
 *         tags={"Tasks"},
 *         summary="Criar uma nova tarefa",
 *         @OA\RequestBody(
 *             required=true,
 *             @OA\JsonContent(
 *                 type="object",
 *                 required={"title", "status", "user_id"},
 *                 @OA\Property(property="title", type="string", example="Nova tarefa"),
 *                 @OA\Property(property="description", type="string", nullable=true, example="Descrição da tarefa"),
 *                 @OA\Property(
 *                     property="status", 
 *                     type="string", 
 *                     enum={"pendente", "em progresso", "concluída"},
 *                     example="pendente"
 *                 ),
 *                 @OA\Property(property="user_id", type="integer", example=1)
 *             )
 *         ),
 *         @OA\Response(
 *             response=201,
 *             description="Tarefa criada com sucesso",
 *             @OA\JsonContent(
 *                 type="object",
 *                 @OA\Property(property="id", type="integer"),
 *                 @OA\Property(property="title", type="string"),
 *                 @OA\Property(property="description", type="string", nullable=true),
 *                 @OA\Property(property="status", type="string"),
 *                 @OA\Property(property="user_id", type="integer"),
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
class TaskController extends Controller{
    public function index(){
        return Task::all();
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:pendente,em progresso,concluída',
            'user_id' => 'required|exists:users,id',
        ]);

        $task = Task::create($request->all());
        return response()->json($task, 201);
    }

    /**
     * @OA\PathItem(
     *     path="/api/tasks/{id}",
     *     @OA\Get(
     *         operationId="getTaskById",
     *         tags={"Tasks"},
     *         summary="Obter uma tarefa por ID",
     *         @OA\Parameter(
     *             name="id",
     *             in="path",
     *             required=true,
     *             @OA\Schema(type="integer")
     *         ),
     *         @OA\Response(
     *             response=200,
     *             description="Tarefa encontrada",
     *             @OA\JsonContent(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer"),
     *                 @OA\Property(property="title", type="string"),
     *                 @OA\Property(property="description", type="string", nullable=true),
     *                 @OA\Property(property="status", type="string"),
     *                 @OA\Property(property="user_id", type="integer"),
     *                 @OA\Property(property="created_at", type="string", format="date-time"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time")
     *             )
     *         ),
     *         @OA\Response(
     *             response=404,
     *             description="Tarefa não encontrada"
     *         )
     *     ),
     *     @OA\Put(
     *         operationId="updateTask",
     *         tags={"Tasks"},
     *         summary="Atualizar uma tarefa",
     *         @OA\Parameter(
     *             name="id",
     *             in="path",
     *             required=true,
     *             @OA\Schema(type="integer")
     *         ),
     *         @OA\RequestBody(
     *             required=true,
     *             @OA\JsonContent(
     *                 type="object",
     *                 @OA\Property(property="title", type="string", example="Tarefa atualizada"),
     *                 @OA\Property(property="description", type="string", nullable=true, example="Descrição atualizada"),
     *                 @OA\Property(
     *                     property="status", 
     *                     type="string", 
     *                     enum={"pendente", "em progresso", "concluída"},
     *                     example="em progresso"
     *                 ),
     *                 @OA\Property(property="user_id", type="integer", example=1)
     *             )
     *         ),
     *         @OA\Response(
     *             response=200,
     *             description="Tarefa atualizada com sucesso",
     *             @OA\JsonContent(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer"),
     *                 @OA\Property(property="title", type="string"),
     *                 @OA\Property(property="description", type="string", nullable=true),
     *                 @OA\Property(property="status", type="string"),
     *                 @OA\Property(property="user_id", type="integer"),
     *                 @OA\Property(property="created_at", type="string", format="date-time"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time")
     *             )
     *         ),
     *         @OA\Response(
     *             response=404,
     *             description="Tarefa não encontrada"
     *         )
     *     ),
     *     @OA\Delete(
     *         operationId="deleteTask",
     *         tags={"Tasks"},
     *         summary="Deletar uma tarefa",
     *         @OA\Parameter(
     *             name="id",
     *             in="path",
     *             required=true,
     *             @OA\Schema(type="integer")
     *         ),
     *         @OA\Response(
     *             response=204,
     *             description="Tarefa deletada com sucesso"
     *         ),
     *         @OA\Response(
     *             response=404,
     *             description="Tarefa não encontrada"
     *         )
     *     )
     * )
     */
    public function show(Task $task){
        return $task;
    }

    public function update(Request $request, Task $task){
        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|nullable|string',
            'status' => 'sometimes|required|string|in:pendente,em progresso,concluída',
            'user_id' => 'sometimes|required|exists:users,id',
        ]);

        $task->update($request->all());
        return $task;
    }

    public function destroy(Task $task){
        $task->delete();
        return response()->noContent();
    }
}
