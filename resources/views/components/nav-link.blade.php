@props(['links' => [], 'type' => ''])
<nav>
    @foreach ($links as $link)
        @if ($type === 'button')
            <button onclick="location.href='{{$link['path']}}'"
                class="{{ request()->is(strtolower($link['nav'])) ? 'rounded-md bg-gray-900 px-3 py-2 text-sm font-medium text-white' : 'rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white'}}"
                aria-current="{{ request()->is(strtolower($link['nav'])) ? 'page' : 'false' }}"
            >
                {{$link['name']}}
            </>
        @else
            <a href="{{$link['path']}}"
                class="{{ request()->is(strtolower($link['nav'])) ? 'rounded-md bg-gray-900 px-3 py-2 text-sm font-medium text-white' : 'rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white'}}"
                aria-current="{{ request()->is(strtolower($link['nav'])) ? 'page' : 'false' }}"
            >
                {{$link['name']}}
            </a>
        @endif
    @endforeach
</nav>