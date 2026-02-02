<x-layout>
    <x-slot name="title">Create Job</x-slot>
    <h1>Create New Job</h1>
    <form action="/jobs" method="POST">
        @csrf
        <div class="my-5">
            <label for="title">Job Title:</label>
            <input type="text" id="title" name="title" required placeholder="title" class="bg-white"
                value="{{ old('title') }}">
            @error('title')
                <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-5">
            <label for="description">Job Description:</label>
            <textarea id="description" name="description" required class="bg-white">{{ old('description') }}</textarea>
            @error('description')
                <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit">Create Job</button>
    </form>
</x-layout>