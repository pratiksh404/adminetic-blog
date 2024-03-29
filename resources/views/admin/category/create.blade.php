@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-create-page name="category" route="category">
    <x-slot name="content">
        {{-- ================================Form================================ --}}
        @include('blog::admin.layouts.modules.category.edit_add')
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-create-page>
@endsection

@section('custom_js')
@include('blog::admin.layouts.modules.category.scripts')
@endsection