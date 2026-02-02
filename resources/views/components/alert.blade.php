@props([
    'type',
    'message',
])
@if(session()->has($type))
    <div class="mb-4 p-4 text-sm text-white rounded {{ $type == 'success' ? 'bg-green-500' : 'bg-red-500'}}">
        {{ $message }}
    </div>
@endif