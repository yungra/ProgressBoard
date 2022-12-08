<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            チャット一覧
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    
                    
                    
                    <section class="text-gray-600 body-font">
                        <div class="container px-5 mx-auto">

                            <div class="flex justify-end mb-4">
                                <button onclick="location.href='{{ route('teacher.chats.index') }}'" class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">新規作成する</button>
                                </div>

                            <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                                <table class="table-auto w-full text-left whitespace-no-wrap">
                                    <thead>
                                        <tr>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">生徒名</th>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">時刻</th>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100"></th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($chat_rooms as $chat_room)
                                        <tr>
                                            <td class="px-4 py-3">{{ $chat_room->student->name }}</td>
                                            <td class="px-4 py-3">{{ $chat_room->updated_at }}</td>
                                            <td class="md:px-4 py-3">
                                                <button onclick="location.href='{{ route('teacher.chats.edit', $chat_room->id) }}'" class="text-white bg-indigo-400 border-0 py-2 px-4 focus:outline-none hover:bg-indigo-600 rounded">メッセージ</button>
                                            </td>

                                        
                                        </tr>
                                        @endforeach
                                
                              </tbody>
                            </table>
                            {{ $chat_rooms->links() }}
                          </div>
                          
                        </div>
                      </section>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
