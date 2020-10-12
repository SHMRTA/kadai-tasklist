@extends('layouts.app')

@section('content')

<!-- ここにページごとのコンテンツを書く -->
    <h1>タスク一覧</h1>
    @if (count($task) > 0)
    <table class="table table-striped">
        <thead>
            <tr>
                <th>id</th>
                <th>タスク</th>
            </tr>
        </thead>
        
        <tbody>
            @foreach ($task as $task)
            <tr>
                {{-- タスク詳細ページへのリンク --}}
                <td>{!! link_to_route('task.show',$task->id, ['task' => $task->id]) !!}</td>
                <td>{{ $task->content }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    @endif
    {{-- タスク作成ページへのリンク --}}
    {!! link_to_route('task.create','新規タスクの投稿',[],['class' => 'btn btn-primary'])!!}
@endsection