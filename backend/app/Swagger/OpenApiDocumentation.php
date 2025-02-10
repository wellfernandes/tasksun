<?php

namespace App\Swagger;

/**
 * @OA\Info(
 *     title="TaskSun API",
 *     version="1.0.0",
 *     description="API para gerenciamento de tarefas",
 *     @OA\Contact(
 *         name="Welliton Fernandes Leal",
 *         email="contato@tasksun.com.br",
 *         url="https://www.tasksun.com.br"
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
 * 
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT"
 * )
 */
class OpenApiDocumentation{

}
