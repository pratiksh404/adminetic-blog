<div class="row">
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card bg-gradient-directional-primary">
            <div class="card-content">
                <div class="card-body">
                    <div class="media d-flex">
                        <div class="align-self-center">
                            <i class="icon-pencil white font-large-2 float-left"></i>
                        </div>
                        <div class="media-body white text-right">
                            <h3>{{ views($post)->count() }}</h3>
                            <span>Total Views</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card bg-gradient-directional-warning">
            <div class="card-content">
                <div class="card-body">
                    <div class="media d-flex">
                        <div class="align-self-center">
                            <i class="icon-pointer white font-large-2 float-left"></i>
                        </div>
                        <div class="media-body white text-right">
                            <h3>{{ views($post)->period(\CyrildeWit\EloquentViewable\Support\Period::pastWeeks(1))->count() }}
                            </h3>
                            <span>This Week Views</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card bg-gradient-directional-danger">
            <div class="card-content">
                <div class="card-body">
                    <div class="media d-flex">
                        <div class="align-self-center">
                            <i class="icon-speech white font-large-2 float-left"></i>
                        </div>
                        <div class="media-body white text-right">
                            <h3>{{ views($post)->period(\CyrildeWit\EloquentViewable\Support\Period::pastMonths(1))->count() }}
                            </h3>
                            <span>This Month Views</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card bg-gradient-directional-success">
            <div class="card-content">
                <div class="card-body">
                    <div class="media d-flex">
                        <div class="align-self-center">
                            <i class="icon-graph white font-large-2 float-left"></i>
                        </div>
                        <div class="media-body white text-right">
                            <h3>{{ views($post)->period(\CyrildeWit\EloquentViewable\Support\Period::pastYears(1))->count() }}
                            </h3>
                            <span>This Year Views</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <!-- Line Basic Chart Start -->
        <div class="card">
            <div class="card-body">
                <div class="card-title">Monthly Views Line Chart</div>
                <div id="monthly-post-views-line-chart" data-id="{{ $post->id }}"></div>
            </div>
        </div>
        <!-- line basic chart end -->
    </div>
    <div class="col-lg-6">
        <!-- Line Basic Chart Start -->
        <div class="card">
            <div class="card-body">
                <div class="card-title">Monthly Views Bar Chart</div>
                <div id="monthly-post-views-bar-chart" data-id="{{ $post->id }}"></div>
            </div>
        </div>
        <!-- line basic chart end -->
    </div>
</div>
