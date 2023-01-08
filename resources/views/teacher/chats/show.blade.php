<x-app-layout>


    <section class="text-gray-600 body-font relative">
        <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-col text-center w-full mb-12">
                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">
                    {{ $chat_room->student->name }}へのメッセージ
                </h1>
            </div>

            <div class="chat-container row justify-content-center">
                @foreach ($chat_room->messages as $item)
                    @if (!$item->is_student)
                        <div class="flex text-left w-3/4">
                            <div>
                                <img src="{{ Storage::url($chat_room->teacher->img_path) }}" width="60px">
                                <span>{{ $chat_room->teacher->name }}</span>
                                <p class="text-sm">{{ $item->created_at }}</p>
                            </div>
                            <p class="text-2xl bg-blue-200 w-full">{{ $item->content }}</p>
                        </div>
                        <br>
                    @else
                        <div class="flex flex-row-reverse text-right w-3/4 ml-auto">
                            <div>
                                <img src="{{ Storage::url($chat_room->student->img_path) }}" width="60px"
                                    class="ml-auto">
                                <p>{{ $chat_room->student->name }}</p>
                                <p class="text-sm">{{ $item->created_at }}</p>
                            </div>
                            <p class="text-2xl bg-gray-300 w-full">{{ $item->content }}</p>
                        </div>
                        <br>
                    @endif
                @endforeach
            </div>

            {{-- メッセージ入力欄 --}}
            <form action="{{ route('teacher.chat.send', $chat_room->student->id) }}" method="post">
                @csrf
                <div class="flex justify-center p-2 w-full">
                    <div class="relative">
                        <label for="message" class="leading-7 text-sm text-gray-600">Message</label>
                        <textarea id="message" name="message"
                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
                    </div>
                </div>
                <div class="p-2 w-full">
                    <button
                        class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">送信</button>
                </div>
            </form>



        </div>
    </section>

</x-app-layout>
