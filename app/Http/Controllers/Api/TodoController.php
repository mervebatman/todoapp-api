<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    public function getTodos()
    {

        $todos = Todo::all();

        if ($todos->count() > 0) {
            return response()->json([
                'status' => 200,
                'todos' => $todos
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Records Found'
            ], 404);
        }
    }

    public function createTodo(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'todo' => 'required|string|max:200',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => $validator->messages()
            ], 422);
        } else {
            $todo = Todo::create([
                'todo' => $request->todo,
            ]);

            if ($todo) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Todo created successfully'
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Something went wrong'
                ], 500);
            }
        }
    }

    public function showTodo($id)
    {
        $todo = Todo::find($id);

        if ($todo) {
            return response()->json([
                'status' => 200,
                'todo' => $todo
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No todo found'
            ], 404);
        }
    }

    public function updateTodo(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'completed' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => $validator->messages()
            ], 422);
        } else {
            $todo = Todo::find($id);

            if ($todo) {

                $todo->update([
                    // 'todo' => $request->todo,
                    'completed' => $request->completed
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => 'Todo updated successfully'
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'No todo found'
                ], 404);
            }
        }
    }

    public function deleteTodo($id)
    {
        $todo = Todo::find($id);

        if ($todo) {

            $todo->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Todo deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No todo found'
            ], 404);
        }
    }
}
