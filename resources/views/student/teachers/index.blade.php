<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            講師一覧
        </h2>
        <form method="GET" action={{ route('student.teachers.index') }}>
            <div class="flex space-x-2 items-center">
                <div><input name="keyword" class="px-3 border border-gray-500 py-2" placeholder="講師名で検索"></div>
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



                            <div class="lg:w-6/7 w-full mx-auto overflow-auto">
                                <table class="table-auto w-full text-left whitespace-no-wrap">
                                    <thead>
                                        <tr>
                                            <th
                                                class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">
                                                顔写真</th>
                                            <th
                                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">
                                                名前</th>
                                            <th
                                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                メールアドレス</th>
                                            <th
                                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                住所</th>
                                            <th
                                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                大学名</th>
                                            <th
                                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                作成日</th>
                                            <th
                                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($teacherPaginate as $teacher)
                                            {{-- ページ内で、全て条件を満たす場合 --}}
                                            @if ($target_count >= $num * $page)
                                                <tr class="bg-amber-300">
                                                    <td class="md:px-4 py-3"><img
                                                            src="{{ Storage::url($teacher->img_path) }}" width="60px">
                                                    </td>
                                                    <td class="md:px-4 py-3">{{ $teacher->name }}</td>
                                                    <td class="md:px-4 py-3">{{ $teacher->email }}</td>
                                                    <td class="md:px-4 py-3">
                                                        {{ $teacher->address->prefecture->name }}{{ $teacher->address->name }}
                                                    </td>
                                                    <td class="md:px-4 py-3">{{ $teacher->university->name }}</td>
                                                    <td class="md:px-4 py-3">{{ $teacher->created_at }}</td>
                                                    <td class="px-4 text-center">
                                                        <button
                                                            onclick="location.href='{{ route('student.chat.show', $teacher->id) }}'"
                                                            class="text-white bg-indigo-400 border-0 py-2 px-4 focus:outline-none hover:bg-indigo-600 rounded">チャット</button>
                                                    </td>
                                                </tr>
                                                @continue
                                                {{-- ページ内で、一部が条件を満たす場合 --}}
                                                {{-- ページ内に条件を満たすものが存在するか --}}
                                            @elseif ($target_count > $num * ($page - 1))
                                                @if ($loop->iteration <= $target_count - $num * ($page - 1))
                                                    <tr class="bg-amber-300">
                                                        <td class="md:px-4 py-3"><img
                                                                src="{{ Storage::url($teacher->img_path) }}"
                                                                width="60px">
                                                        </td>
                                                        <td class="md:px-4 py-3">{{ $teacher->name }}</td>
                                                        <td class="md:px-4 py-3">{{ $teacher->email }}</td>
                                                        <td class="md:px-4 py-3">
                                                            {{ $teacher->address->prefecture->name }}{{ $teacher->address->name }}
                                                        </td>
                                                        <td class="md:px-4 py-3">{{ $teacher->university->name }}</td>
                                                        <td class="md:px-4 py-3">{{ $teacher->created_at }}</td>
                                                        <td class="px-4 text-center">
                                                            <button
                                                                onclick="location.href='{{ route('student.chat.show', $teacher->id) }}'"
                                                                class="text-white bg-indigo-400 border-0 py-2 px-4 focus:outline-none hover:bg-indigo-600 rounded">チャット</button>
                                                        </td>
                                                    </tr>
                                                    @continue
                                                @endif
                                            @endif
                                            <tr>
                                                <td class="md:px-4 py-3"><img
                                                        src="{{ Storage::url($teacher->img_path) }}" width="60px">

                                                </td>
                                                <td class="md:px-4 py-3">{{ $teacher->name }}</td>
                                                <td class="md:px-4 py-3">{{ $teacher->email }}</td>
                                                <td class="md:px-4 py-3">
                                                    {{ $teacher->address->prefecture->name }}{{ $teacher->address->name }}
                                                </td>
                                                <td class="md:px-4 py-3">{{ $teacher->university->name }}</td>
                                                <td class="md:px-4 py-3">{{ $teacher->created_at }}</td>
                                                <td class="px-4 text-center">
                                                    <button
                                                        onclick="location.href='{{ route('teacher.chat.show', $teacher->id) }}'"
                                                        class="text-white bg-indigo-400 border-0 py-2 px-4 focus:outline-none hover:bg-indigo-600 rounded">チャット</button>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                {{ $teacherPaginate->appends([
                                        'pagination' => \Request::get('pagination'),
                                    ])->links() }}
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
