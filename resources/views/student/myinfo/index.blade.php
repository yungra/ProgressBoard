<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            登録情報
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    
                    
                    
                    <section class="text-gray-600 body-font">
                        <div class="container px-5 mx-auto">



                            <div class="lg:w-3/4 w-full mx-auto overflow-auto">
                                <table class="table-auto w-full text-left whitespace-no-wrap">
                                    <thead>
                                        <tr>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">名前</th>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">メールアドレス</th>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">住所</th>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">学校</th>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">志望校</th>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">作成日</th>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="px-4 py-3">{{ $myinfo->name }}</td>
                                            <td class="px-4 py-3">{{ $myinfo->email }}</td>
                                            <td class="px-4 py-3">{{ $myinfo->address->prefecture->name}}{{ $myinfo->address->name }}</td>
                                            <td class="px-4 py-3">{{ $myinfo->school->name }}</td>
                                            <td class="px-4 py-3">{{ $myinfo->desired_school->name }}</td>
                                            <td class="px-4 py-3">{{ $myinfo->created_at }}</td>
                                            <td class="px-4 text-center">
                                                <button onclick="location.href='{{ route('student.myinfo.edit', $myinfo->id) }}'" class="text-white bg-indigo-400 border-0 py-2 px-4 focus:outline-none hover:bg-indigo-600 rounded">編集</button>
                                            </td>

                                        
                                        </tr>
                              </tbody>
                            </table>
                          </div>
                          
                        </div>
                      </section>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
