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
                            <div class="lg:w-1/2 md:w-2/3 mx-auto">
                                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                                <form method="post"
                                    action="{{ route('student.questionnaire.update', ['id' => $questionnaire->id]) }}">
                                    {{-- @method('PUT')   --}}
                                    @csrf
                                    <div class="-m-2">

                                        <input type="hidden" id="guidance_report_id" name="guidance_report_id" value={{ $id }} />


                                        <div class="p-2 w-1/2 mx-auto">
                                            <div class="relative">
                                                <label for="comprehension" required
                                                    class="leading-7 text-sm text-gray-600">理解度</label><br>
                                                <select name="comprehension">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($questionnaire->comprehension === $i)
                                                            <option selected>{{ $i }}</option>
                                                        @else
                                                            <option>{{ $i }}</option>
                                                        @endif
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>

                                      <div class="p-2 w-1/2 mx-auto">
                                            <div class="relative">
                                                <label for="speed" required
                                                    class="leading-7 text-sm text-gray-600">授業スピード</label><br>
                                                <select name="speed">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($questionnaire->speed === $i)
                                                            <option selected>{{ $i }}</option>
                                                        @else
                                                            <option>{{ $i }}</option>
                                                        @endif
                                                    @endfor
                                                </select>
                                            </div>
                                    </div>

                                    <div class="p-2 w-1/2 mx-auto">
                                        <div class="relative">
                                            <label for="satisfaction" required
                                                class="leading-7 text-sm text-gray-600">授業スピード</label><br>
                                            <select name="satisfaction">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($questionnaire->satisfaction === $i)
                                                        <option selected>{{ $i }}</option>
                                                    @else
                                                        <option>{{ $i }}</option>
                                                    @endif
                                                @endfor
                                            </select>
                                        </div>
                                    </div>

                                    <div class="p-2 w-1/2 mx-auto">
                                        <div class="relative">
                                            <label for="free" required
                                                class="leading-7 text-sm text-gray-600">自由記述</label>

                                            <textarea type="text" id="free" name="free"
                                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                        {{ $questionnaire->free }}  
                                        </textarea>
                                        </div>
                                    </div>


                                    <div class="p-2 w-full flex justify-around mt-4">
                                        <button type="button"
                                            onclick="location.href='{{ route('student.reports.index', ['id' => $id]) }}'"
                                            class="bg-gray-200 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
                                        <button type="submit"
                                            class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">更新する</button>
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
