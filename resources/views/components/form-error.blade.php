@props(['name'])

@error($name)
    <div class="mt-1">
        <p class="text-xs font-bold text-red-500">{{$message}}</p>
    </div>
@enderror