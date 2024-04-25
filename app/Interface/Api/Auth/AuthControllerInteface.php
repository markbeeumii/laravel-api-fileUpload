<?php

namespace App\Interface\Api\Auth;

use App\Requests\Api\Auth\LoginRequest;

interface AuthControllerInteface{
    /**
     * @OA\Post(path="/auth/v1/login",
     *   tags={"Auth"},
     *   summary="User login",
     *   description="User login with email and password",
     *   operationId="login",
     *   @OA\RequestBody(
     *       required=true,
     *       @OA\JsonContent(ref="#/components/schemas/LoginRequest")
     *   ),
     *   @OA\Response(response="default", description="successful operation")
     * )
     * @param App\Http\Requests\Api\Auth\LoginRequest $request
    */
  public function login(LoginRequest $req);

    /**
     * @OA\Post(path="/auth/v1/logout",
     *   tags={"Auth"},
     *   summary="User logout",
     *   description="User logout",
     *   operationId="logout",
     *   @OA\Response(response="default", description="successful operation")
     * )
     * @return bool
    */
  public function logout();


  /**
   * 
   * 
   * @param App\Http\Requests\Api\Auth\LoginRequest $request
   */
  public function register(LoginRequest $request);
}