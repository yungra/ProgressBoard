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
                    <section class="text-gray-600 body-font relative">
                        <div class="container px-5 mx-auto">
                          <div class="flex flex-col text-center w-full mb-12">
                            <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">登録情報</h1>
                          </div>
                          <div class="lg:w-1/2 md:w-2/3 mx-auto">
                            <x-auth-validation-errors class="mb-4" :errors="$errors" />
                            <form method="get" action="{{ route('teacher.myinfo.edit', ['id' => $myinfo->id]) }}">
                              {{-- @method('PUT')   --}}
                              {{-- @csrf --}}
                            <div class="-m-2">
                                <div class="p-2 w-1/2 mx-auto">
                                    <div class="relative">
                                      <label for="img_path" required class="leading-7 text-sm text-gray-600">顔写真</label>
                                      <img src="{{ Storage::url($myinfo->img_path) }}" >
                                    </div>
                                  </div>
                              <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                  <label for="name" required class="leading-7 text-sm text-gray-600">名前</label>
                                  <input type="text" id="name" name="name" value="{{ $myinfo->name }}" readonly class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                              </div>
                              <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                  <label for="email" required class="leading-7 text-sm text-gray-600">メールアドレス</label>
                                  <input type="email" id="email" name="email" value="{{ $myinfo->email }}" readonly class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                            </div>
                            
                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                    <label for="address" class="leading-7 text-sm text-gray-600">住所</label>
                                    <input type="address" id="address" name="address" value="{{ $myinfo->address->prefecture->name }}{{ $myinfo->address->name }}" readonly class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                              </div>

                              <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                  <label for="university" class="leading-7 text-sm text-gray-600">大学</label>
                                  <input type="university" id="university" name="university" value="{{ $myinfo->university->name}}" readonly class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
 
                                </div>
                              </div>

                              

                              <div class="p-2 w-full flex justify-around mt-4">
                                <button type="submit" class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">編集する</button>
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

