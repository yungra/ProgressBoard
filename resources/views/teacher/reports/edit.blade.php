<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            指導報告書編集
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <section class="text-gray-600 body-font relative">
                        <div class="container px-5 mx-auto">
                            <div class="flex flex-col text-center w-full mb-12">
                                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">指導報告書編集</h1>
                            </div>
                            <div class="lg:w-1/2 md:w-2/3 mx-auto">
                                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                                <form method="post"
                                    action="{{ route('teacher.reports.update', ['report' => $report->id]) }}">
                                    @method('PUT')
                                    @csrf
                                    <div class="-m-2">

                                            <div class="p-2 w-1/2 mx-auto">
                                                <div class="relative">
                                                    <label for="student" required
                                                        class="leading-7 text-sm text-gray-600">生徒名</label>
                                                    <select name="student" id="student"
                                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                        @foreach ($students as $student)
                                                            @if ($student->id === $report->student->id)
                                                                <option value="{{ $student->id }}" selected>
                                                                    {{ $student->name }}
                                                                </option>
                                                            @else
                                                                <option value="{{ $student->id }}">
                                                                    {{ $student->name }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="p-2 w-1/2 mx-auto">
                                                <div class="relative">
                                                    <label for="name" required
                                                        class="leading-7 text-sm text-gray-600">授業日</label>

                                                    <input type="date" id="class_day" name="class_day"
                                                        value="{{ $report->class_day }}"
                                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                </div>
                                            </div>

                                            <div class="p-2 w-1/2 mx-auto">
                                                <div class="relative">
                                                    <label for="email" required
                                                        class="leading-7 text-sm text-gray-600">コマ名</label>
                                                    <select name="timetable" id="timetable"
                                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                        @foreach ($timetables as $timetable)
                                                            @if ($timetable->id === $report->timetable->id)
                                                                <option value="{{ $timetable->id }}" selected>
                                                                    {{ $timetable->name }}
                                                                </option>
                                                            @else
                                                                <option value="{{ $timetable->id }}">
                                                                    {{ $timetable->name }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="p-2 w-1/2 mx-auto">
                                                <div class="relative">
                                                    <label for="email" required
                                                        class="leading-7 text-sm text-gray-600">科目名</label>
                                                    <select name="subject" id="subject"
                                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                        @foreach ($subjects as $subject)
                                                            @if ($subject->id === $report->subject->id)
                                                                <option value="{{ $subject->id }}" selected>
                                                                    {{ $subject->name }}
                                                                </option>
                                                            @else
                                                                <option value="{{ $subject->id }}">
                                                                    {{ $subject->name }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="p-2 w-1/2 mx-auto">
                                                <div class="relative">
                                                    <label for="teacher" required
                                                        class="leading-7 text-sm text-gray-600">担当講師</label>
                                                    <select name="teacher" id="teacher"
                                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                        @foreach ($teachers as $teacher)
                                                            @if ($teacher->id === $report->teacher->id)
                                                                <option value="{{ $teacher->id }}" selected>
                                                                    {{ $teacher->name }}
                                                                </option>
                                                            @else
                                                                <option value="{{ $teacher->id }}">
                                                                    {{ $teacher->name }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="p-2 w-1/2 mx-auto">
                                                <div class="relative">
                                                    <label for="report" required
                                                        class="leading-7 text-sm text-gray-600">内容</label>

                                                        <textarea type="text" id="report" name="report"
                                                        value="{{ $report->report }}" 
                                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                        {{ $report->report }}
                                                        </textarea>
                                                </div>
                                            </div>

                                            <div class="p-2 w-full flex justify-around mt-4">
                                                <button type="button" onclick="location.href='{{ route('teacher.reports.index') }}'" class="bg-gray-200 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
                                                <button type="submit" class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">更新する</button>
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
