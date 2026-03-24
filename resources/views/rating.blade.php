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
                            @php
                                $place = $index + 1;

                                if ($place == 1) {
                                    $rowClass = 'bg-yellow-300 hover:bg-yellow-400';
                                }elseif ($place == 2){
                                    $rowClass = 'bg-gray-300 hover:bg-gray-400';
                                }elseif ($place == 3){
                                    $rowClass = 'bg-orange-300 hover:bg-orange-400';
                                }else
                                    $rowClass = 'border-b dark:border-gray-700';

                                if (auth()->id() === $topUser->user->id){
                                    $rowClass .= ' bg-blue-50';
                                }

                            @endphp
                            <tr class="{{$rowClass}}">
                                <th class=" px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    @if($place == 1)
                                        🥇

                                    @elseif($place == 2)
                                        🥈

                                    @elseif($place == 3)
                                        🥉

                                    @else
                                        {{$place}}
                                    @endif
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
