<?php

namespace App\Swagger;

/**
 * @OA\Info(
 *     title="TaskSun API",
 *     version="1.0.0",
 *     description="API para gerenciamento de tarefas",
 *     @OA\Contact(
 *         name="Welliton Fernandes Leal",
 *         url="https://www.linkedin.com/in/wellitonfernandes/"
 *     ),
 *     @OA\License(
 *         name="MIT License",
 *         url="https://opensource.org/licenses/MIT"
 *     )
 * )
 * 
 * @OA\Server(
 *     url="/api/v1",
 *     description="Servidor de API principal"
 * )
 */

/**
 * @OA\Schema(
 *     schema="UserRegistration",
 *     type="object",
 *     required={"name", "email", "password", "password_confirmation"},
 *     @OA\Property(
 *         property="name", 
 *         type="string", 
 *         description="Nome completo do usuário",
 *         example="João Silva"
 *     ),
 *     @OA\Property(
 *         property="email", 
 *         type="string", 
 *         format="email", 
 *         description="Endereço de email do usuário",
 *         example="joao.silva@example.com"
 *     ),
 *     @OA\Property(
 *         property="password", 
 *         type="string", 
 *         format="password", 
 *         description="Senha do usuário (mínimo 8 caracteres)",
 *         minLength=8
 *     ),
 *     @OA\Property(
 *         property="password_confirmation", 
 *         type="string", 
 *         format="password", 
 *         description="Confirmação da senha"
 *     )
 * )
 */

/**
 * @OA\Schema(
 *     schema="User",
 *     type="object",
 *     required={"name", "email"},
 *     @OA\Property(
 *         property="id", 
 *         type="integer", 
 *         description="Identificador único do usuário",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="name", 
 *         type="string", 
 *         description="Nome completo do usuário",
 *         example="João Silva"
 *     ),
 *     @OA\Property(
 *         property="email", 
 *         type="string", 
 *         format="email", 
 *         description="Endereço de email do usuário",
 *         example="joao.silva@example.com"
 *     ),
 *     @OA\Property(
 *         property="created_at", 
 *         type="string", 
 *         format="date-time", 
 *         description="Data de criação do usuário"
 *     ),
 *     @OA\Property(
 *         property="updated_at", 
 *         type="string", 
 *         format="date-time", 
 *         description="Data da última atualização do usuário"
 *     )
 * )
 */

/**
 * @OA\Schema(
 *     schema="UserWithToken",
 *     type="object",
 *     @OA\Property(
 *         property="user", 
 *         ref="#/components/schemas/User",
 *         description="Informações do usuário"
 *     ),
 *     @OA\Property(
 *         property="token", 
 *         type="string", 
 *         description="Token de autenticação JWT",
 *         example="eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
 *     )
 * )
 */

/**
 * @OA\Schema(
 *     schema="UserLogin",
 *     type="object",
 *     required={"email", "password"},
 *     @OA\Property(
 *         property="email", 
 *         type="string", 
 *         format="email", 
 *         description="Endereço de email do usuário",
 *         example="joao.silva@example.com"
 *     ),
 *     @OA\Property(
 *         property="password", 
 *         type="string", 
 *         format="password", 
 *         description="Senha do usuário"
 *     )
 * )
 */

/**
 * @OA\Schema(
 *     schema="Task",
 *     type="object",
 *     required={"title", "status", "user_id"},
 *     @OA\Property(
 *         property="id", 
 *         type="integer", 
 *         description="Identificador único da tarefa",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="title", 
 *         type="string", 
 *         description="Título da tarefa",
 *         example="Desenvolver relatório"
 *     ),
 *     @OA\Property(
 *         property="description", 
 *         type="string", 
 *         description="Descrição detalhada da tarefa",
 *         example="Criar relatório mensal de vendas"
 *     ),
 *     @OA\Property(
 *         property="status", 
 *         type="string", 
 *         description="Status atual da tarefa",
 *         enum={"pendente", "em progresso", "concluída"},
 *         example="pendente"
 *     ),
 *     @OA\Property(
 *         property="user_id", 
 *         type="integer", 
 *         description="ID do usuário responsável pela tarefa",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="created_at", 
 *         type="string", 
 *         format="date-time", 
 *         description="Data de criação da tarefa"
 *     ),
 *     @OA\Property(
 *         property="updated_at", 
 *         type="string", 
 *         format="date-time", 
 *         description="Data da última atualização da tarefa"
 *     )
 * )
 */
