<div class="btn-group" role="group" aria-label="Actions">
    {{-- Nút Sửa --}}
    <x-utils.edit-button :href="route('admin.company.edit', $company)" />
    <x-utils.view-button :href="route('admin.company.show', $company)" />

</div>
