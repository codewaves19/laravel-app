<x-layout>
    <x-slot:heading>
        Jobs Page
    </x-slot:heading>
    <div class="space-y-4">
    @foreach ($jobs as $job)
    <a href="/jobs/{{ $job['id'] }}" class="block px-4 py-6 border border-gray-200 rounded-lg">
        <div class="font-bold text-blue-500 text-sm">{{ $job->employer->name }}</div>
        <div>
        <strong>{{ $job['title'] }}:</strong> Pays {{ $job['salary'] }} per years.
        </div>
    </a>
    <form method="POST" action="/jobs/{{ $job->id }}" id="delete-form">
        @csrf
        @method('DELETE')
        <button type="submit" id="delete-form" class="text-red-500 text-sm font-bold">Delete</button>
    
      </form>
    @endforeach
    <div>{{ $jobs->links() }}</div>
</div>
</x-layout>
