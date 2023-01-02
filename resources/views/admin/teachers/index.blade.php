<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            講師一覧
        </h2>
        <form method="GET" action={{ route('admin.teachers.index') }}>
            <div class="flex space-x-2 items-center">
                <div><input name="keyword" class="border border-gray-500 py-2" placeholder="講師名で検索"></div>
                <div><button
                        class="ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">検索する</button>
                </div>
            </div>
            <span class="text-sm">表示件数</span><br>
            <select id="pagination" name="pagination">
                <option value="2" @if (\Request::get('pagination') === '2') selected @endif>2件
                </option>
                <option value="5" @if (\Request::get('pagination') === '5') selected @endif>5件
                </option>
                <option value="10" @if (\Request::get('pagination') === '10') selected @endif>10件
                </option>
            </select>
        </form>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    
                    
                    
                    <section class="text-gray-600 body-font">
                        <div class="container px-5 mx-auto">

                            <div class="flex justify-end mb-4">
                            <button onclick="location.href='{{ route('admin.teachers.create') }}'" class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">新規登録する</button>
                            </div>

                            <div class="lg:w-5/6 w-full mx-auto overflow-auto">
                                <table class="table-auto w-full text-left whitespace-no-wrap">
                                    <thead>
                                        <tr>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">名前</th>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">メールアドレス</th>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">住所</th>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">大学名</th>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">作成日</th>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($teachers as $teacher)
                                        <tr>
                                            <td class="px-4 py-3">{{ $teacher->name }}</td>
                                            <td class="px-4 py-3">{{ $teacher->email }}</td>
                                            <td class="px-4 py-3">{{ $teacher->address->prefecture->name}}{{ $teacher->address->name }}</td>
                                            <td class="px-4 py-3">{{ $teacher->university->name }}</td>
                                            <td class="px-4 py-3">{{ $teacher->created_at }}</td>
                                            <td class="px-4 py-3">
                                                <button onclick="location.href='{{ route('admin.teachers.edit', $teacher->id) }}'" class="text-white bg-indigo-400 border-0 py-2 px-4 focus:outline-none hover:bg-indigo-600 rounded">編集</button>
                                            </td>

                                            <form id="delete_{{$teacher->id}}" method="post" action="{{ route('admin.teachers.destroy', ['teacher' => $teacher->id ] )}}">
                                                @csrf
                                                @method('delete')
                                                    <td class="px-4 py-3">
                                                    <a href="#" data-id="{{  $teacher->id }}" onclick="deletePost(this)" class="text-white bg-red-400 border-0 py-2 px-4 focus:outline-none hover:bg-red-600 rounded">削除</a>
                                                </td>
                                                </form>
                                        </tr>
                                        @endforeach
                                
                              </tbody>
                            </table>
                            {{ $teachers->appends([
                                'pagination' => \Request::get('pagination'),
                            ])->links() }}                          </div>
                          
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
        const paginate = document.getElementById('pagination')
        paginate.addEventListener('change', function() {
            this.form.submit()
        })
        </script>
</x-app-layout>
