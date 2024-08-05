<x-layout currentPage="Job">
    <x-slot:title>
        Job Specification
    </x-slot:title>

    <h1 class="font-bold">{{$job->title}}</h1>
    <h2>Pays ${{$job->salary}} a year</h2>

    @can('edit', $job)
        <form method="POST" action="/jobs/{{$job->id}}" class="mt-6">
            @csrf
            @method('DELETE')
            <p class="flex items-center gap-[10px]">
                <x-link-button href="/jobs/{{$job->id}}/edit">Edit Job</x-link-button>
                <button>Delete Job</button>
            </p>
        </form>
    @endcan
</x-layout>