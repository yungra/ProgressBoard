<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            指導報告書詳細
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <section class="text-gray-600 body-font relative">
                        <div class="container px-5 mx-auto">
                            <div class="flex flex-col text-center w-full mb-12">
                                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">指導報告書詳細</h1>
                            </div>
                            {{-- <div class="lg:w-1/2 md:w-2/3 mx-auto"> --}}
                            <div class="w-full">
                                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                                <form method="get"
                                    action="{{ route('teacher.reports.edit', ['report' => $report->id]) }}">
                                    {{-- @method('PUT') --}}
                                    {{-- @csrf --}}
                                    <div class="-m-2">

                                        <div class="flex flex-row w-full">
                                            {{-- 左カラム --}}
                                            <div class="w-1/3">

                                                <div class="p-2 w-1/2 mx-auto">
                                                    <div class="relative">
                                                        <label for="email" required
                                                            class="leading-7 text-sm text-gray-600">授業日</label>
                                                        <input type="email" id="email" name="email"
                                                            value="{{ $report->class_day }}" readonly
                                                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                    </div>
                                                </div>

                                                <div class="p-2 w-1/2 mx-auto">
                                                    <div class="relative">
                                                        <label for="email" required
                                                            class="leading-7 text-sm text-gray-600">コマ名</label>
                                                        <input type="email" id="email" name="email"
                                                            value="{{ $report->timetable->name }}" readonly
                                                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                    </div>
                                                </div>

                                                <div class="p-2 w-1/2 mx-auto">
                                                    <div class="relative">
                                                        <label for="email" required
                                                            class="leading-7 text-sm text-gray-600">科目名</label>
                                                        <input type="email" id="email" name="email"
                                                            value="{{ $report->subject->name }}" readonly
                                                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                    </div>
                                                </div>

                                                <div class="p-2 w-1/2 mx-auto">
                                                    <div class="relative">
                                                        <label for="email" required
                                                            class="leading-7 text-sm text-gray-600">担当講師</label>
                                                        <input type="email" id="email" name="email"
                                                            value="{{ $report->teacher->name }}" readonly
                                                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                    </div>
                                                </div>

                                            </div>

                                            {{-- 右カラム --}}
                                            <div class="w-2/3">

                                                <div class="p-2 w-full">
                                                    <div class="relative">
                                                        <label for="email" required
                                                            class="leading-7 text-sm text-gray-600">内容</label>
                                                        <textarea type="text" id="report" name="report" value="{{ $report->report }}" readonly
                                                            class="min-w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                    {{ $report->report }}
                                                    </textarea>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>


                                        <div class="p-2 w-full flex justify-around mt-4">
                                            <button type="button"
                                                onclick="location.href='{{ route('student.reports.index') }}'"
                                                class="bg-gray-200 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
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
