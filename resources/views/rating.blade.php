@extends('layouts.app')

@section('content')



    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-center  text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th class="px-4 py-3">Место</th>
                            <th class="px-4 py-3">Пользователь</th>
                            <th class="px-4 py-3">Очки</th>
                        </tr>
                        </thead>

                        <tbody class="text-center">
                        @foreach($topUsers as $index => $topUser)
                            <tr class="border-b dark:border-gray-700">
                                <th class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{$index + 1}}
                                </th>
                                <th class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{$topUser->user->name}}
                                </th>
                                <th class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{$topUser->total_score}}
                                </th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
