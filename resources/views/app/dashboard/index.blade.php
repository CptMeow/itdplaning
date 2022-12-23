<x-app-layout>
  <x-slot:content>
    <div class="container-fluid">
      <div class="animated fadeIn">
        <!-- Widget Card number -->
        <div class="row mb-3">
          <div class="col-sm-6 col-md-3 col-lg-2">
            <div class="card">
              <div class="card-body">
                <div class="text-medium-emphasis text-end mb-4">
                  <svg class="icon icon-xxl">
                    <use xlink:href=" {{ asset('vendors/@coreui/icons/sprites/free.svg#cil-building') }}"></use>
                  </svg>
                </div>
                <div class="fs-4 fw-semibold">{{ $projects }}</div><small class="text-medium-emphasis text-uppercase fw-semibold">โครงการ/งานประจำ</small>
                <div class="progress progress-thin mt-3 mb-0">
                  <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-6 col-md-3 col-lg-2">
            <div class="card">
              <div class="card-body">
                <div class="text-medium-emphasis text-end mb-4">
                  <svg class="icon icon-xxl">
                    <use xlink:href=" {{ asset('vendors/@coreui/icons/sprites/free.svg#cil-description') }}"></use>
                  </svg>
                </div>
                <div class="fs-4 fw-semibold">{{ $contracts }}</div><small class="text-medium-emphasis text-uppercase fw-semibold">สัญญา</small>
                <div class="progress progress-thin mt-3 mb-0">
                  <div class="progress-bar bg-info" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            </div>
          </div>

          {{-- <div class="col-sm-6 col-md-3 col-lg-2">
            <div class="card">
              <div class="card-body">
                <div class="text-medium-emphasis text-end mb-4">
                  <svg class="icon icon-xxl">
                    <use xlink:href=" {{ asset('vendors/@coreui/icons/sprites/free.svg#cil-money') }}"></use>
                  </svg>
                </div>
                <div class="fs-4 fw-semibold">{{ Helper::millionFormat($amount) }}</div><small class="text-medium-emphasis text-uppercase fw-semibold">มูลค่าทั้งหมด</small>
                <div class="progress progress-thin mt-3 mb-0">
                  <div class="progress-bar bg-warning" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-6 col-md-3 col-lg-2">
            <div class="card">
              <div class="card-body">
                <div class="text-medium-emphasis text-end mb-4">
                  <svg class="icon icon-xxl">
                    <use xlink:href=" {{ asset('vendors/@coreui/icons/sprites/free.svg#cil-money') }}"></use>
                  </svg>
                </div>
                <div class="fs-4 fw-semibold">{{ Helper::millionFormat($vendor_blacklist) }}</div><small class="text-medium-emphasis text-uppercase fw-semibold">คู่ค้าที่ขึ้นบัญชีดำ</small>
                <div class="progress progress-thin mt-3 mb-0">
                  <div class="progress-bar bg-danger" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            </div>
          </div> --}}

        </div><!-- End Widget Card number -->

        <!-- Widget Chart -->
        <div class="row mb-3 d-none">
          <div class="col-sm-6 col-md-6 col-lg-6">
            <div class="card">
              <div class="card-body">
                <div class="card-title fs-5 fw-semibold">TEST</div>
                <div id="chartdiv" class="chartdiv"></div>
              </div>
            </div>
          </div>

          <div class="col-sm-6 col-md-6 col-lg-6">
            <div class="card">
              <div class="card-body">
                <div class="card-title fs-5 fw-semibold">TEST</div>
                <div id="chartdiv2" class="chartdiv"></div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
    <style>
      .chartdiv {
        width: 100%;
        height: 250px;
      }
    </style>
  </x-slot:content>
  <x-slot:javascript>
    <!-- Resources -->
    <script src="{{ asset('vendors/amcharts5/index.js') }}"></script>
    <script src="{{ asset('vendors/amcharts5/xy.js') }}"></script>
    <script src="{{ asset('vendors/amcharts5/percent.js') }}"></script>
    <script src="{{ asset('vendors/amcharts5/themes/Animated.js') }}"></script>
    <!-- Chart code -->
    <script>
      am5.ready(function() {
        // Create root element
        // https://www.amcharts.com/docs/v5/getting-started/#Root_element
        var root = am5.Root.new("chartdiv");

        // Set themes
        // https://www.amcharts.com/docs/v5/concepts/themes/
        root.setThemes([
          am5themes_Animated.new(root)
        ]);

        // Create chart
        // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
        var chart = root.container.children.push(am5percent.PieChart.new(root, {
          layout: root.verticalLayout
        }));

        // Create series
        // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
        var series = chart.series.push(am5percent.PieSeries.new(root, {
          valueField: "value",
          categoryField: "category"
        }));

        // Set data
        // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
        series.data.setAll([{
            value: 10,
            category: "One"
          },
          {
            value: 9,
            category: "Two"
          },
          {
            value: 6,
            category: "Three"
          },
          {
            value: 5,
            category: "Four"
          },
          {
            value: 4,
            category: "Five"
          },
          {
            value: 3,
            category: "Six"
          },
          {
            value: 1,
            category: "Seven"
          },
        ]);

        // Play initial series animation
        // https://www.amcharts.com/docs/v5/concepts/animations/#Animation_of_series
        series.appear(1000, 100);

      }); // end am5.ready()

      am5.ready(function() {
        // Create root element
        // https://www.amcharts.com/docs/v5/getting-started/#Root_element
        var root = am5.Root.new("chartdiv2");

        // Set themes
        // https://www.amcharts.com/docs/v5/concepts/themes/
        root.setThemes([
          am5themes_Animated.new(root)
        ]);

        // Create chart
        // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
        var chart = root.container.children.push(am5percent.PieChart.new(root, {
          layout: root.verticalLayout
        }));

        // Create series
        // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
        var series = chart.series.push(am5percent.PieSeries.new(root, {
          valueField: "value",
          categoryField: "category"
        }));

        // Set data
        // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
        series.data.setAll([{
            value: 10,
            category: "One"
          },
          {
            value: 9,
            category: "Two"
          },
          {
            value: 6,
            category: "Three"
          },
          {
            value: 5,
            category: "Four"
          },
          {
            value: 4,
            category: "Five"
          },
          {
            value: 3,
            category: "Six"
          },
          {
            value: 1,
            category: "Seven"
          },
        ]);

        // Play initial series animation
        // https://www.amcharts.com/docs/v5/concepts/animations/#Animation_of_series
        series.appear(1000, 100);

      }); // end am5.ready()
    </script>
  </x-slot:javascript>
</x-app-layout>
