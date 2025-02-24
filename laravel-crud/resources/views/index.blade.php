@extends('layouts.base')

@section('content')
<div class="row">
    <div class="col-12">
        <div>
            <h2 class="text-white mt-5">CRUD de Tareas</h2>
        </div>
        <div>
            <a href="{{route('tasks.create')}}" class="btn btn-primary">Crear tarea</a>
        </div>
    </div>
    @if (Session::get('success'))
        <div class="alert alert-success mt-3">
            <strong>{{Session::get('success')}}<br>
        </div>
    @endif

    <div class="col-12 mt-4">
        <table class="table table-bordered text-white">
            <tr class="text-secondary">
                <th>Tarea</th>
                <th>Descripción</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Acción</th>
            </tr>
            @foreach($tasks as $task)
                <tr>
                    <td class="fw-bold">{{$task->title}}</td>
                    <td>{{$task->description}}</td>
                    <td>
                        {{$task->due_date}}
                    </td>
                    <td>
                        <span class="badge fs-6 
                        @if($task->status == 'Pendiente') bg-warning
                        @elseif($task->status == 'En progreso') bg-info
                        @elseif($task->status == 'Completada') bg-success
                        @else bg-danger
                        @endif">
                        {{$task->status}}
                    </span>
                    </td>
                    <td>
                        <a href="" class="btn btn-warning">Editar</a>

                        <form action="{{route('tasks.destroy', $task)}}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta tarea?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        {{$tasks->links()}}
    </div>
</div>
@endsection