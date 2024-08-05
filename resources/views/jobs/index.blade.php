<x-layout currentPage="Jobs">
    <x-slot:title>Jobs</x-slot:title>

    <div>
        @foreach ($jobs as $job)
            <a href="/jobs/{{$job['id']}}"
                class="hover:text-blue-500 hover:no-underline block px-5 py-3 border border-gray-200 rounded-lg">
                <div class="font-bold text-blue-500">
                    {{$job->employer->name}}
                </div>
                <div>
                    <span class="font-bold text-laracasts">{{$job['title']}}: </span>
                    <span>Pays ${{$job['salary']}} a year</span>
                </div>
            </a>
        @endforeach
        <div class="mt-2.5">
            {{$jobs->links()}}
        </div>
    </div>
</x-layout>