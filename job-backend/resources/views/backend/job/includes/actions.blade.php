<div class="btn-group" role="group" aria-label="Actions">

    <x-utils.list-button :href="route('admin.job.application', $job)" />
    <x-utils.edit-button :href="route('admin.job.edit', $job)" />
    <x-utils.view-button :href="route('admin.job.show', $job)" />

</div>
