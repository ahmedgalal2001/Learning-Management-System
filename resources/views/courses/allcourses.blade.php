<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Courses') }}
        </h2>
    </x-slot>

    <form class="max-w-md mx-auto mt-2" method="GET" action="{{ route('course.allcourses') }}">
        <div class="flex">
            <label for="search-dropdown" class="mb-2 text-sm font-medium text-gray-900 sr-only">Type</label>
            <div id="dropdown" class="bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                <select
                    class="py-2.5 px-4 block w-full text-sm text-gray-900 bg-white  border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                    id="search-dropdown" name="type">
                    <option value="title" {{ old('type') === 'title' ? 'selected' : '' }}>Title</option>
                    <option value="description" {{ old('type') === 'description' ? 'selected' : '' }}>Description
                    </option>
                </select>
            </div>
            <div class="relative w-full">
                <input type="search" id="search-dropdown" name="search" value="{{ request()->query('search') }}"
                    class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-white rounded-e-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 placeholder:text-gray-400"
                    placeholder="Search for courses ..." required />
                <button type="submit"
                    class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-blue-700 rounded-e-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                    <span class="sr-only">Search</span>
                </button>
            </div>
        </div>
    </form>

    <div class="container mx-auto px-4 py-8">
        @if (count($courses) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($courses as $course)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        {{-- <img class="w-full h-48 object-cover" src="{{ optional($course->image) ? asset($course->image->url) : 'placeholder.jpg' }}" alt="{{ $course->title }}"> --}}
                        <div class="p-4">
                            <h5 class="text-xl font-medium mb-2">{{ $course->title }}</h5>
                            <p class="text-gray-700 mb-4">{{ Str::limit($course->description, 100) }}</p>
                            <a href="{{ route('lesson.index', $course->id) }}" type="button"
                                class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 text-white rounded-lg hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 shadow-lg shadow-purple-500/50 dark:shadow-lg dark:shadow-purple-800">
                                <svg class="mr-2 -ml-1 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M5 8a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H9a1 1 0 01-1-1V8zM12 9a1 1 0 00-1-1h-4a1 1 0 00-1 1v4a1 1 0 001 1h4a1 1 0 001-1v-4z">
                                    </path>
                                    <path fill-rule="evenodd"
                                        d="M10 5a1 1 0 011 1v3h3a1 1 0 011 1v5a1 1 0 01-1 1H11a1 1 0 01-1-1v-5a1 1 0 00-1-1z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span>Show Lessons</span>
                            </a>
                            @if (!$courses_enrolled_ids->contains($course->id))
                                <a href="{{ route('course.enrollCourse', $course->id) }}" type="button"
                                    class="inline-flex items-center text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-2.5">
                                    <svg class="mr-2 -ml-1 w-4 h-4" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M5 8a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H9a1 1 0 01-1-1V8zM12 9a1 1 0 00-1-1h-4a1 1 0 00-1 1v4a1 1 0 001 1h4a1 1 0 001-1v-4z">
                                        </path>
                                        <path fill-rule="evenodd"
                                            d="M10 5a1 1 0 011 1v3h3a1 1 0 011 1v5a1 1 0 01-1 1H11a1 1 0 01-1-1v-5a1 1 0 00-1-1z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    <span>Enroll In</span>
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="flex items-center p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50" role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v
            4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">Info alert!</span> No courses found.
                </div>
            </div>
        @endif
    </div>

</x-app-layout>
