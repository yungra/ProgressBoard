<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            授業アンケート
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <section class="text-gray-600 body-font relative">
                        <div class="container px-5 mx-auto">
                            <div class="flex flex-col text-center w-full mb-12">
                                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">授業アンケート</h1>
                            </div>

                            <div class="flex">

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
                                <div class="w-2/3 mx-auto">

                                    <div class="flex">
                                        {{-- 選択式アンケートカラム --}}
                                        <div class="w-1/3">

                                            <div class="p-2 w-1/2 mx-auto">
                                                <div class="relative">
                                                    <label for="comprehension" required
                                                        class="leading-7 text-sm text-gray-600">理解度</label><br>
                                                    <input type="text" id="comprehension" name="comprehension"
                                                        value={{ "$questionnaire->comprehension" }} readonly
                                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                </div>
                                            </div>

                                            <div class="p-2 w-1/2 mx-auto">
                                                <div class="relative">
                                                    <label for="speed" required
                                                        class="leading-7 text-sm text-gray-600">授業スピード</label><br>
                                                    <input type="text" id="speed" name="speed"
                                                        value={{ "$questionnaire->speed" }} readonly
                                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                </div>
                                            </div>

                                            <div class="p-2 w-1/2 mx-auto">
                                                <div class="relative">
                                                    <label for="satisfaction" required
                                                        class="leading-7 text-sm text-gray-600">満足度</label><br>
                                                    <input type="text" id="satisfaction" name="satisfaction"
                                                        value={{ "$questionnaire->satisfaction" }} readonly
                                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                </div>
                                            </div>

                                        </div>

                                        {{-- 自由記述カラム --}}
                                        <div class="w-2/3">
                                            <div class="p-2 w-full mx-auto">
                                                <div class="relative">
                                                    <label for="free" required
                                                        class="leading-7 text-sm text-gray-600">自由記述</label>

                                                    <textarea type="text" id="free" name="free" readonly style="white-space: pre-wrap;"
                                                        class="h-96 w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ $questionnaire->free }}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="p-2 w-full flex justify-around mt-4">
                                        <button type="button"
                                            onclick="location.href='{{ route('teacher.reports.index', ['id' => $report_id]) }}'"
                                            class="bg-gray-200 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
