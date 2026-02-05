@extends('layouts.app')

@section('content')



    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table>
                        <tr>
                            <th>Место</th>
                            <th>Пользователь</th>
                            <th>Очки</th>
                        </tr>
                        @foreach($topUsers as $index => $topUser)
                            <tr>
                                <th>{{$index + 1}}</th>
                                <th>{{$topUser->user->name}}</th>
                                <th>{{$topUser->total_score}}</th>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
