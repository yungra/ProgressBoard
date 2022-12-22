<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            削除済み講師一覧
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    
                    
                    
                    <section class="text-gray-600 body-font">
                        <div class="container px-5 mx-auto">

                

                            <div class="lg:w-6/7 w-full mx-auto overflow-auto">
                                <table class="table-auto w-full text-left whitespace-no-wrap">
                                    <thead>
                                        <tr>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">名前</th>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">メールアドレス</th>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">住所</th>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">学校名</th>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">志望校名</th>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">削除した日</th>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($expiredTeachers as $teacher)
                                        <tr>
                                            <td class="px-4 py-3">{{ $teacher->name }}</td>
                                            <td class="px-4 py-3">{{ $teacher->email }}</td>
                                            <td class="px-4 py-3">{{ $teacher->address->prefecture->name}}{{ $teacher->address->name }}</td>
                                            <td class="px-4 py-3">{{ $teacher->university->name}}</td>
                                            <td class="px-4 py-3">{{ $teacher->deleted_at }}</td>
                                            
                                            {{-- route('ルート名', ['パラメータ名'=>'値']) --}}
                                            
                                            <form id="delete_{{$teacher->id}}" method="post" action="{{ route('admin.expired-teachers.destroy', ['teacher' => $teacher->id ] )}}">
                                            @csrf
                                                <td class="px-4 py-3">
                                                <a href="#" data-id="{{  $teacher->id }}" onclick="deletePost(this)" class="text-white bg-red-400 border-0 py-2 px-4 focus:outline-none hover:bg-red-600 rounded">完全に削除</a>
                                            </td>
                                            </form>
                                        </tr>

                                        @endforeach
                                
                              </tbody>
                            </table>
                          </div>
                          
                        </div>
                      </section>

                </div>
            </div>
        </div>
    </div>
    <script>
        function deletePost(e) {
            'use strict';
            if (confirm('本当に削除してもいいですか?')) {
            document.getElementById('delete_' + e.dataset.id).submit();
            }
        }
        </script>
</x-app-layout>
