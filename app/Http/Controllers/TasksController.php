<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Task;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        //タスクを取得
        $task = Task::all();
        
        
        // ログインしていたらタスク一覧を表示
        if (\Auth::check()) {
            
            //↓loginControllerのログイン情報をログとして吐き出す
            // logger(\Auth::user());
            
            return view('task.index',['task' => $task,]);
        } else {
            // ログインしていなかったらログイン画面を表示
            return view('auth/login');
        }
        
        
        
        //タスク一覧ビューでそれを表示
        return view('task.index',['task' => $task,]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //getでTasks/createにアクセスされた場合の新規登録画面表示
        $task = new Task;
        
        //タスク作成ビューを表示
        return view('task.create',['task' => $task,]);
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     // postでtask/にアクセスされた場合の「新規登録処理」
    public function store(Request $request)
    {   
        //バリテーション
        $request->validate([
            'status' => 'required|max:10',
            ]);
    
        //タスクを作成
        $task = new Task;
        
        //↓が問題
        //$task->user_id = $request->user_id;
        
        $usr_id = \Auth::user()->id;
        $task->user_id =$usr_id;
        
        
        $task->status = $request->status;
        $task->content = $request->content;
        
        //logger($task);
        
        $task->save();
        
        //トップページへリダイレクトさせる
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
      // getでtask/idにアクセスされた場合の「取得表示処理」
    public function show($id)
    {
        //idの値でタスクを検索して取得
        $task = Task::findOrFail($id);
        
        //タスク詳細ビューでそれを表示
        return view('task.show',['task' => $task]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
      // getでtask/id/editにアクセスされた場合の「更新画面表示処理」
    public function edit($id)
    {
        //idの値でタスクを検索して取得
        $task = Task::findOrFail($id);
        
        //タスク編集ビューでそれを表示
        return view('task.edit',['task' => $task]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     
     // putまたはpatchでtask/idにアクセスされた場合の「更新処理」
    public function update(Request $request, $id)
    {   
        //バリテーション
        $request->validate([
            'status' => 'required|max:10',
            ]);
            
        //idの値でタスクを検索して取得
        $task = Task::findOrFail($id);
        //タスクを更新
        $task->status = $request->status;
        $task->content = $request->content;
        $task->save();
        
        //トップページへリダイレクトさせる
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     
     // deleteでtask/idにアクセスされた場合の「削除処理」
    public function destroy($id)
    {
        //idの値でタスクを検索して取得
        $task = Task::findOrFail($id);
        //タスクを削除
        $task->delete();
        
        //トップページへリダイレクトさせる
        return redirect('/');
        
    }
}
