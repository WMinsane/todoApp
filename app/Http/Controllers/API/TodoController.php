<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TodoController extends Controller
{
    // 一覧初期表示時
    public function getTodoList()
    {
        $sql = 'SELECT * FROM TODO_LIST';
        $items = DB::select($sql);
        return $items;
    }

    // 詳細更新モード起動時
    public function getTodo(Request $req)
    {
        $todoId = $req->input('todoId');
        $sql = 'SELECT * FROM TODO_LIST WHERE TODO_ID = :todoId';
        $items = DB::select($sql, ['todoId' => $todoId]);
        return $items;
    }

    // 新規作成
    public function createTodo(Request $req)
     {
        $params = $req -> only(['TODO_NAME', 'STATUS']);
        $sql = <<< 'SQL'
        INSERT 
        INTO todo_list(TODO_NAME, STATUS, CREATE_DATE) 
        VALUES (:TODO_NAME, :STATUS, CURDATE())
        SQL;
        DB::insert($sql, $params);
     }

    // 更新
    public function updateTodo(Request $req)
    {
        $params = $req -> only(['TODO_NAME', 'STATUS', 'TODO_ID']);
        $sql = <<< 'SQL'
        UPDATE todo_list 
        SET
            TODO_NAME = :TODO_NAME
            , STATUS = :STATUS
        WHERE
            TODO_ID = :TODO_ID
        SQL;
        DB::update($sql, $params);
    } 
    // 削除
    public function deleteTodo(Request $req)
    {
        $todoId = $req -> input('todoId');
        $sql = 'DELETE FROM TODO_LIST WHERE TODO_ID = :todoId';
        DB::delete($sql,['todoId' => $todoId]);
    }
}
