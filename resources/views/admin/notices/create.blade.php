<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            お知らせ登録
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <section class="text-gray-600 body-font relative">
                        <div class="container px-5 mx-auto">
                            <div class="flex flex-col text-center w-full mb-12">
                                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">お知らせ登録</h1>
                            </div>
                            <div class="w-full">
                                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                                <form method="post" action="{{ route('admin.notice.store') }}">
                                    @csrf

                                    <div class="flex flex-row w-full">
                                        {{-- 左カラム --}}
                                        <div class="w-1/3">

                                            <div class="w-2/3 mx-auto">
                                                <div class="relative">
                                                    <label for="student_name"
                                                        class="leading-7 text-sm text-gray-600">対象</label>
                                                    <select name="is_student" id="is_student"
                                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                        <option value=1
                                                            @if ('is_student' === (int) old('is_student')) selected @endif>
                                                            生徒向け
                                                        </option>
                                                        <option value=0
                                                            @if ('is_student' === (int) old('is_student')) selected @endif>
                                                            講師向け
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="w-2/3 mx-auto">
                                                <div class="relative">
                                                    <label for="subject"
                                                        class="leading-7 text-sm text-gray-600">件名</label>
                                                    <br>
                                                    <textarea name="subject">{{ old('subject') }}</textarea>
                                                </div>
                                            </div>

                                        </div>

                                        {{-- 右カラム --}}
                                        <div class="w-2/3">

                                            <div class="p-2 w-full ml-20">
                                                <div class="relative">
                                                    <label for="content"
                                                        class="leading-7 text-sm text-gray-600">内容</label>
                                                    <br>
                                                    <textarea id="content" name="content" class="w-2/3">{{ old('content') }}</textarea>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="p-2 w-full flex justify-around mt-4">
                                        <button type="button"
                                            onclick="location.href='{{ route('admin.notice.index') }}'"
                                            class="bg-gray-200 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
                                        <button type="submit"
                                            class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">送信する</button>
                                    </div>
                            </div>
                            </form>
                        </div>
                </div>
                </section>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
