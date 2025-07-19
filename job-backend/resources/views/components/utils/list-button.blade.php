@props(['href' => '#', 'permission' => false])

<x-utils.link :href="$href" class="btn btn-info btn-sm" icon="fas fa-list" :text="__('List')" permission="{{ $permission }}" />
