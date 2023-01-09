<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            お知らせ詳細
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <section class="text-gray-600 body-font relative">
                        <div class="container px-5 mx-auto">
                            <div class="flex flex-col text-center w-full mb-12">
                                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">お知らせ詳細</h1>
                            </div>
                            {{-- <div class="lg:w-1/2 md:w-2/3 mx-auto"> --}}
                            <div class="w-full">
                                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                                {{-- @method('PUT') --}}
                                {{-- @csrf --}}
                                <div class="-m-2">

                                    <div class="flex flex-row w-full">
                                        {{-- 左カラム --}}
                                        <div class="w-1/3">

                                            <div class="p-2 w-1/2 mx-auto">
                                                <div class="relative">
                                                    <label for="subject" required
                                                        class="leading-7 text-sm text-gray-600">件名</label>
                                                    <textarea id="subject" name="subject" readonly
                                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                        {{ $notice->subject }}
                                                    </textarea>
                                                </div>
                                            </div>

                                            <div class="p-2 w-1/2 mx-auto">
                                                <div class="relative">
                                                    <label for="email" required
                                                        class="leading-7 text-sm text-gray-600">対象</label>
                                                    @if ($notice->is_student)
                                                        <input type="is_student" id="is_student" name="is_student"
                                                            value="生徒向け" readonly
                                                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                    @else
                                                        <input type="is_student" id="is_student" name="is_student"
                                                            value="講師向け" readonly
                                                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                    @endif
                                                </div>
                                            </div>

                                            {{-- 改行するため、button要素を使用 --}}
                                            <div class="p-2 w-1/2 mx-auto">
                                                <div class="relative">
                                                    <label for="subject" required
                                                        class="leading-7 text-sm text-gray-600">送信日</label>
                                                    <button id="date" name="date" readonly
                                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                        {{ $notice->created_at->format('Y年m月d日') }}<br>{{ $notice->created_at->format('H時i分s秒') }}
                                                    </button>
                                                </div>
                                            </div>

                                        </div>
                                        {{-- 右カラム --}}
                                        <div class="w-2/3">

                                            <div class="p-2 w-full">
                                                <div class="relative">
                                                    <label for="email" required
                                                        class="leading-7 text-sm text-gray-600">お知らせ内容</label>
                                                    <textarea type="text" id="content" name="content" value="{{ $notice->content }}" readonly
                                                        class="min-w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                    {{ $notice->content }}
                                                    </textarea>
                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                    <div class="p-2 w-full flex justify-around mt-4">
                                        <button type="button"
                                            onclick="location.href='{{ route('admin.notice.index') }}'"
                                            class="bg-gray-200 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
                                    </div>
                                </div>
                            </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
