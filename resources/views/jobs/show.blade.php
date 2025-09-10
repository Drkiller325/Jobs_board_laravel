<x-layout>
    <x-slot:heading>
        Job
    </x-slot:heading>

    <h2 class="font-bold text-lg">{{$job->title}}</h2>

    <p>
        This job pays {{$job->salary}} per year
    </p>

    <?php // this is an if the user can edit run the logic (check JobController) ?>
    @can('edit', $job)
        <?php //'mt' = margin top ?>
        <p class="mt-6">
            <x-button href="/jobs/{{ $job->id }}/edit">Edit Job</x-button>
        </p>
    @endcan
</x-layout>
