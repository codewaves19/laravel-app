@props(['name'])

@error($name)
    <p class="text-xs text-red-500 text-semi-bold mt-1">{{ $message }}</p>
@enderror