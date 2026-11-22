<?php

use OpenApi\Annotations as OA;

class UserPaths
{
    /**
     * @OA\Get(
     *     path="/users",
     *     tags={"users"},
     *     summary="Get all users",
     *     @OA\Response(response=200, description="List of all users", @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/User")))
     * )
     */
    public function getUsers() {}

    /**
     * @OA\Get(
     *     path="/users/{id}",
     *     tags={"users"},
     *     summary="Get user by ID",
     *     @OA\Parameter(name="id", in="path", required=true, example=1, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="User details", @OA\JsonContent(ref="#/components/schemas/User")),
     *     @OA\Response(response=404, description="User not found", @OA\JsonContent(ref="#/components/schemas/Error"))
     * )
     */
    public function getUsersById() {}

    /**
     * @OA\Post(
     *     path="/users",
     *     tags={"users"},
     *     summary="Register a new user",
     *     @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/UserInput")),
     *     @OA\Response(response=201, description="User created", @OA\JsonContent(ref="#/components/schemas/User")),
     *     @OA\Response(response=400, description="Validation error or email already in use", @OA\JsonContent(ref="#/components/schemas/Error"))
     * )
     */
    public function postUsers() {}

    /**
     * @OA\Put(
     *     path="/users/{id}",
     *     tags={"users"},
     *     summary="Update a user",
     *     @OA\Parameter(name="id", in="path", required=true, example=1, @OA\Schema(type="integer")),
     *     @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/UserInput")),
     *     @OA\Response(response=200, description="User updated", @OA\JsonContent(ref="#/components/schemas/User")),
     *     @OA\Response(response=400, description="Validation error", @OA\JsonContent(ref="#/components/schemas/Error")),
     *     @OA\Response(response=404, description="User not found", @OA\JsonContent(ref="#/components/schemas/Error"))
     * )
     */
    public function putUsersById() {}

    /**
     * @OA\Delete(
     *     path="/users/{id}",
     *     tags={"users"},
     *     summary="Delete a user",
     *     @OA\Parameter(name="id", in="path", required=true, example=1, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="User deleted", @OA\JsonContent(ref="#/components/schemas/Message")),
     *     @OA\Response(response=404, description="User not found", @OA\JsonContent(ref="#/components/schemas/Error"))
     * )
     */
    public function deleteUsersById() {}
}