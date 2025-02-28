<x-layout>
    <x-slot:heading>
        Jobs Listing
    </x-slot:heading>

    <ul>
        @foreach($jobs as $job)
        <li class="hover:underline hover:text-blue-900">
            <a href="/jobs/{{ $job['id'] }} ">
                <strong> {{ $job['title'] }}: </strong> Pays {{ $job['salary'] }} per year.
            </a>
        </li>
        @endforeach
    </ul>
</x-layout>
