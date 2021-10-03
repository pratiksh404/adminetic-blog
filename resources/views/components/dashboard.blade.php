<div>
    {{-- Model Count --}}
    @include('blog::admin.layouts.modules.dashboard.model_count')
    {{-- Month View Charts --}}
    @include('blog::admin.layouts.modules.dashboard.monthly_views_chart')

    <div class="row">
        @include('blog::admin.layouts.modules.dashboard.most_viewed_posts')
    </div>

    @section('custom_js')
    @include('blog::admin.layouts.modules.dashboard.scripts')
    @endsection
</div>