<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <form method="POST" action="{{ route('course.update', $course->id) }}" class="max-w-md mx-auto shadow p-6">
            <h1 class="text-2xl text-center  mb-4">Create Course</h1>
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" value="{{ $course->title }}" id="title"
                    class="mt-1 p-2 w-full border rounded-md" required>
            </div>
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" rows="4" class="mt-1 p-2 w-full border rounded-md" required>{{ $course->description }}</textarea>
            </div>
            <div class="mt-4">
                <button type="submit"
                    class="px-4 py-2 bg-blue-500 hover:bg-blue-600 focus:bg-blue-600 text-white rounded-md">Update</button>
            </div>
        </form>
    </div>
</x-app-layout>
