<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            生徒一覧
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="md:p-6 text-gray-900">
                    <section class="text-gray-600 body-font">
                        <div class="container md:px-5 mx-auto">

                            <div class="lg:w-4/5 w-full mx-auto overflow-auto">
                                <table class="table-auto w-full text-left whitespace-no-wrap">
                                    <thead>
                                        <tr>
                                            <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">名前</th>
                                            <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">メールアドレス</th>
                                            <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">住所</th>
                                            <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">学校名</th>
                                            <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">志望校名</th>
                                            <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">作成日</th>
                                            <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($students as $student)
                                        <tr>
                                            <td class="md:px-4 py-3">{{ $student->name }}</td>
                                            <td class="md:px-4 py-3">{{ $student->email }}</td>
                                            <td class="md:px-4 py-3">{{ $student->address->prefecture->name}}{{ $student->address->name }}</td>
                                            <td class="md:px-4 py-3">{{ $student->school->name}}</td>
                                            <td class="md:px-4 py-3">{{ $student->desired_school->name}}</td>
                                            <td class="md:px-4 py-3">{{ $student->created_at }}</td>
                                            <td class="px-4 text-center">
                                                <button onclick="location.href='{{ route('teacher.chat.show', $student->id) }}'" class="text-white bg-indigo-400 border-0 py-2 px-4 focus:outline-none hover:bg-indigo-600 rounded">チャット</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                
                              </tbody>
                            </table>
                            {{ $students->links() }}
                          </div>
                          
                        </div>
                      </section>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
