@extends('layouts.app')
@section('title')
    My Todo App
@endsection

@section('content')
<div class="row mt-3">
        <div class="col-12 align-self-center">
            <ul class="list-group">
                @forelse($todos as $todo)
                    <li class="list-group-item"><a href="details/{{$todo->id}}">{{$todo->name}}</a></li>
                @empty
                    <li class="list-group-item"><a href="#">No todos available</a></li>
                @endforelse
            </ul>
        </div>
    </div>
@endsection