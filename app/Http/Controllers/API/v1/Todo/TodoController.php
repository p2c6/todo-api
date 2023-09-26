<?php

namespace App\Http\Controllers\API\v1\Todo;

use App\Http\Controllers\Controller;
use App\Http\Resources\TodoCollection;
use App\Http\Resources\TodoResource;
use App\Models\Todo\Todo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = Todo::paginate();

        return (new TodoCollection($todos))->response();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'title' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }


            $todo = Todo::create([
                'title' => $request->title
            ]);

            return (new TodoResource($todo))->response()->setStatusCode(JsonResponse::HTTP_CREATED);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Server Error'], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
            info("Storing Todo error: " . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todo\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        return (new TodoResource($todo))->response();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
        try {

            $validator = Validator::make($request->all(), [
                'title' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            }


            $todo->update([
                'title' => $request->title
            ]);

            return (new TodoResource($todo))->response();
        } catch (\Throwable $e) {
            info("Updating Todo error: " . $e->getMessage());
            return response()->json(['message' => 'Server Error'], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        try {
            $todo->delete();
            return response(null, Response::HTTP_NO_CONTENT);
        } catch (\Throwable $e) {
            info("Deleting Todo error: " . $e->getMessage());
            return response()->json(['message' => 'Server Error'], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
