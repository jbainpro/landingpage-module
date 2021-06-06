@extends('core::layouts.app')
@section('title', __('Dashboard'))
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-600">@lang('Dashboard')</h1>
</div>
<div class="row">
  <div class="col-xl-4 col-md-6 mb-4">
    <a href="{{route('landingpages.index')}}" class="text-decoration-none">
    <div class="card shadow h-100">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="font-weight-bold text-gray-600 text-uppercase mb-1">
            @lang('LandingPages')</div>
            <div class="h5 mb-0 font-weight-bold text-gray-600">{{ $landingpage_count }}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
   </a>
  </div>
  <div class="col-xl-4 col-md-6 mb-4">
    <a href="{{route('leads.index')}}" class="text-decoration-none">
    <div class="card shadow h-100">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="font-weight-bold text-gray-600 text-uppercase mb-1">@lang('Leads')
            </div>
            <div class="row no-gutters align-items-center">
              <div class="col-auto">
                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-600">{{ $formdata_count }}</div>
              </div>
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-user-friends fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
    </a>
  </div>
  <div class="col-xl-4 col-md-6 mb-4">
    <a href="{{route('landingpages.index')}}" class="text-decoration-none">
    <div class="card shadow h-100">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="font-weight-bold text-gray-600 text-uppercase mb-1">
            @lang('Landingpages Unpublish')</div>
            <div class="h5 mb-0 font-weight-bold text-gray-600">{{$landingpage_unpublish}}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-id-card fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
   </a>
  </div>
</div>
<div class="row">
  <div class="col-lg-6 mb-4">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-gray-600">@lang('Browser Leads')</h6>
      </div>
      <div class="card-body">
        @php
        $total = $stats_browser->sum('total');
        @endphp
        @foreach($stats_browser as $item)
        @php
        $percent = get_percentage($total,$item->total);
        @endphp
        <h6>{{ $item->browser }} <small>({{$item->total}})</small><span class="float-right">{{ $percent }}%</span></h6>
        <div class="progress mb-4">
          <div class="progress-bar bg-{{random_color()}}" role="progressbar" style="width: {{ $percent }}%" aria-valuenow="{{ $percent }}" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        @endforeach
      </div>
    </div>
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-gray-600">@lang('OS Leads')</h6>
      </div>
      <div class="card-body">
        @php
        $total = $stats_os->sum('total');
        @endphp
        @foreach($stats_os as $item)
        @php
        $percent = get_percentage($total,$item->total);
        @endphp
        <h6>{{ $item->os }} <small>({{$item->total}})</small><span class="float-right">{{ $percent }}%</span></h6>
        <div class="progress mb-4">
          <div class="progress-bar bg-{{random_color()}}" role="progressbar" style="width: {{ $percent }}%" aria-valuenow="{{ $percent }}" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        @endforeach
      </div>
      
    </div>
  </div>
  <div class="col-lg-6 mb-4">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-gray-600">@lang('Device Leads')</h6>
      </div>
      <!-- Card Body -->
      <div class="card-body">
        <div class="chart-pie pt-4 pb-2">
          <canvas id="devicePieChart"></canvas>
        </div>
      </div>
    </div>
  </div>
  
</div>
<div class="row">
  <div class="col-lg-6 mb-4">
    
  </div>
  
</div>

@if(count($stats_device) > 0)
  @php
    $arr_total_device = array();
    $arr_str_device = array();
    $arr_colors = get_color_chart_count(count($stats_device));
  @endphp
  @foreach($stats_device as $item)
    @php
      $arr_total_device[] = $item->total;
      $arr_str_device[] = $item->device;
    @endphp
  @endforeach

  @push('scripts')
      <script type="text/javascript">
        var arr_total_device = @json($arr_total_device);
        var arr_str_device = @json($arr_str_device);
        var arr_colors = @json($arr_colors);
      </script>

      <script src="{{ Module::asset('landingpage:js/dashboard.js') }}" ></script>
  @endpush
@endif

@stop