<x-app-layout>
    @if (session()->has('success'))
        <x-toast :message="session()->get('success')" />
    @endif

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lessons for Course : ' . $course->title . '') }}
        </h2>
    </x-slot>
    <div class="container mx-auto px-4 py-8">
        @if (Auth::user()->is_admin)
            <div class="mb-4">
                <a href="{{ route('lesson.create', $course->id) }}"
                    class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Create
                    Lesson</a>
            </div>
        @endif
        @if ($lessons->count() > 0)
            <table class="w-full text-sm text-left rtl:text-right text-gray-700 bg-white">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left truncate-header">
                            Title
                        </th>
                        <th scope="col" class="px-6 py-3 text-left truncate-header">
                            Description
                        </th>
                        @if (Auth::user()->is_admin)
                            <th scope="col" class="px-6 py-3 text-left truncate-header">
                                Action
                            </th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lessons as $lesson)
                        <tr class="bg-white border-b">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $lesson->title }}
                            </th>
                            <td class="px-6 py-4">
                                {{ Str::limit($lesson->description, 50) }}
                            </td>
                            @if (Auth::user()->is_admin)
                                <td class="px-6 py-4">
                                    <a href="{{ route('lesson.edit', $lesson->id) }}"
                                        class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 ">Edit</a>

                                    <form action="{{ route('lesson.destroy', $lesson->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Delete</button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $lessons->links() }}
            </div>
        @else
            <div class="flex items-center p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50" role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">Info alert!</span> No lessons found.
                </div>
            </div>

        @endif
    </div>
</x-app-layout>
