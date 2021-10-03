@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-edit-page name="post" route="post" :model="$post">
    <x-slot name="content">
        {{-- ================================Form================================ --}}
        @include('blog::admin.layouts.modules.post.edit_add')
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-edit-page>
@endsection

@section('custom_js')
@include('blog::admin.layouts.modules.post.scripts')
@endsection