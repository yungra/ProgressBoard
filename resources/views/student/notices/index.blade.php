<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            お知らせ一覧
        </h2>
        <form method="GET" action={{ route('admin.notice.index') }}>
            <div class="flex space-x-2 items-center">
                <div><input type="text" name="keyword" class="border border-gray-500 py-2" placeholder="件名で検索"></div>
                <div><input type="date" name="date" class="border border-gray-500 py-2"></div>
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

                            <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                                <table class="table-auto w-full text-left whitespace-no-wrap">
                                    <thead>
                                        <tr>
                                            <th
                                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                件名</th>
                                            <th
                                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                送信日</th>
                                            <th
                                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($notices as $notice)
                                            <tr>
                                                <td class="px-4 py-3">{{ $notice->subject }}</td>
                                                <td class="px-4 py-3">{{ $notice->created_at }}</td>
                                                <td class="px-4 py-3">
                                                    <button
                                                        onclick="location.href='{{ route('student.notice.show', $notice->id) }}'"
                                                        class="text-white bg-indigo-400 border-0 py-2 px-4 focus:outline-none hover:bg-indigo-600 rounded">詳細</button>
                                                </td>



                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                {{ $notices->links() }}
                            </div>

                        </div>
                    </section>

                </div>
            </div>
        </div>
    </div>
    <script>
        const paginate = document.getElementById('pagination')
        paginate.addEventListener('change', function() {
            this.form.submit()
        })
    </script>
</x-app-layout>
