<x-layout>
    <x-slot:heading>
        Job
    </x-slot:heading>
    <h2>{{ $job['title'] }}</h2>
    <p>This job pays {{ $job['salary'] }} salary per year.</p>
</x-layout>
