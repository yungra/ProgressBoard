<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            生徒登録
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <section class="text-gray-600 body-font relative">
                        <div class="container px-5 mx-auto">
                          <div class="flex flex-col text-center w-full mb-12">
                            <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">生徒登録</h1>
                          </div>
                          <div class="lg:w-1/2 md:w-2/3 mx-auto">
                            <x-auth-validation-errors class="mb-4" :errors="$errors" />
                            <form method="post" action="{{ route('admin.students.store') }}">
                                @csrf
                            <div class="-m-2">
                              <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                  <label for="name" required class="leading-7 text-sm text-gray-600">名前</label>
                                  <input type="text" id="name" name="name" value="{{ old('name') }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                              </div>
                              <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                  <label for="email" required class="leading-7 text-sm text-gray-600">メールアドレス</label>
                                  <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                              </div>

                              <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                  <label for="address" class="leading-7 text-sm text-gray-600">住所</label>
                                  <select name="address" id="address" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    @foreach($prefectures as $prefecture)
                                     <optgroup label="{{ $prefecture->name }}">
                                      @foreach($prefecture->cities as $city)
                                        <option value="{{ $city->id}}" >
                                         {{ $city->name }}
                                        </option>
                                      @endforeach
                                    @endforeach
                                   </select>    
                                </div>
                              </div>

                              <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                  <label for="school" class="leading-7 text-sm text-gray-600">学校</label>
                                  <select name="school" id="school" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    @foreach($schools as $school)
                                        <option value="{{ $school->id}}" >
                                         {{ $school->name }}
                                        </option>
                                    @endforeach
                                   </select>    
                                </div>
                              </div>

                              <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                  <label for="desired_school" class="leading-7 text-sm text-gray-600">志望校</label>
                                  <select name="desired_school" id="desired_school" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    @foreach($schools as $desired_school)
                                        <option value="{{ $desired_school->id}}" >
                                         {{ $desired_school->name }}
                                        </option>
                                    @endforeach
                                   </select>    
                                </div>
                              </div>

                              <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                  <label for="password" required class="leading-7 text-sm text-gray-600">パスワード</label>
                                  <input type="password" id="password" name="password" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                              </div>
                              <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                  <label for="password_confirmation" required class="leading-7 text-sm text-gray-600">パスワード確認</label>
                                  <input type="password" id="password_confirmation" name="password_confirmation" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                              </div>

                              <div class="p-2 w-full flex justify-around mt-4">
                                <button type="button" onclick="location.href='{{ route('admin.students.index') }}'" class="bg-gray-200 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
                                <button type="submit" class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">登録する</button>
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
