<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Enrolled Courses') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-8 overflow-x-auto">
        @if (count($courses) > 0)
            <table class="w-full text-sm text-left rtl:text-right text-gray-700 bg-white">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left truncate-header">
                            Title
                        </th>
                        <th scope="col" class="px-6 py-3 text-left truncate-header">
                            Description
                        </th>
                        <th scope="col" class="px-6 py-3 text-left truncate-header">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($courses as $course)
                        <tr class="bg-white border-b">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $course->title }}
                            </th>
                            <td class="px-6 py-4">
                                {{ Str::limit($course->description, 100) }}
                            </td>

                            <td class="px-6 py-4 flex flex-col md:flex-row justify-center items-center">
                                <a href="{{ route('lesson.index', $course->id) }}" type="button"
                                    class="mt-3 me-2 text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 shadow-lg shadow-purple-500/50 dark:shadow-lg dark:shadow-purple-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mb-2 md:mb-0 md:me-2">
                                    Show Lessons
                                </a>
                                <form action="{{ route('course.unenrollCourse', $course->id) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="mt-3 md:mt-0 text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Unenroll</button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="flex items-center p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50" role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">Info alert!</span> No courses you have enrolled.
                </div>
            </div>
        @endif
        <div class="mt-4">
            {{ $courses->links() }}
        </div>
    </div>
</x-app-layout>
