@extends('layouts.app')

@section('content')
    @include('admin.quizzes._form', [
        'quiz' => null,
    ])
@endsection
