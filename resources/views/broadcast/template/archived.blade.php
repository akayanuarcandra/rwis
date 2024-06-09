@extends('admin-layout.base')

@section('content')
    @vite('resources/css/resident/app.css')
    <x-crud-container
        title="Broadcast Template"
        :breadcrumbs="[
            ['href' => route('dashboard'), 'title' => 'Dashboard'],
            ['href' => route('broadcast.index'), 'title' => 'Siaran'],
            ['href' => route('broadcast.template.index'), 'title' => 'Template Siaran'],
            ['href' => route('broadcast.template.archived'), 'title' => 'Arsip Template Siaran'],
        ]"
    >
        <livewire:broadcast-template-archived-table />
    </x-crud-container>
@endsection
