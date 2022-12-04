<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            削除済み生徒一覧
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    
                    
                    
                    <section class="text-gray-600 body-font">
                        <div class="container px-5 mx-auto">

                

                            <div class="lg:w-2/3 w-full mx-auto overflow-auto">
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
                                        @foreach ($expiredStudents as $student)
                                        <tr>
                                            <td class="px-4 py-3">{{ $student->name }}</td>
                                            <td class="px-4 py-3">{{ $student->email }}</td>
                                            <td class="px-4 py-3">{{ $student->address->prefecture->name}}{{ $student->address->name }}</td>
                                            <td class="px-4 py-3">{{ $student->school->name}}</td>
                                            <td class="px-4 py-3">{{ $student->desired_school->name}}</td>
                                            <td class="px-4 py-3">{{ $student->deleted_at }}</td>
                                            
                                            {{-- route('ルート名', ['パラメータ名'=>'値']) --}}
                                            
                                            <form id="delete_{{$student->id}}" method="post" action="{{ route('admin.expired-students.destroy', ['student' => $student->id ] )}}">
                                            @csrf
                                                <td class="px-4 py-3">
                                                <a href="#" data-id="{{  $student->id }}" onclick="deletePost(this)" class="text-white bg-red-400 border-0 py-2 px-4 focus:outline-none hover:bg-red-600 rounded">完全に削除</a>
                                            </td>
                                            </form>
                                        </tr>

                                        {{-- <form id="delete_{{$student->id}}" method="post" action="{{ route('admin.students.destroy', ['student' => $student->id ] )}}">
                                            @csrf
                                            @method('delete')
                                            <td class="md:px-4 py-3">
                                              <a href="#" data-id="{{ $student->id }}" onclick="deletePost(this)" class="text-white bg-red-400 border-0 py-2 px-4 focus:outline-none hover:bg-red-500 rounded ">削除</a>                        
                                            </td>
                                          </form>
                                        </tr> --}}

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
