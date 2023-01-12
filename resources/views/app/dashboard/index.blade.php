<x-app-layout>
  <x-slot:content>
    <div class="container-fluid">
      <div class="animated fadeIn">
        <!-- Widget Card number -->
        <div class="row mb-3">
          <div class="col-sm-3 col-md-3 col-lg-2">
            <div class="card">
              <div class="card-body">
                <div class="text-medium-emphasis text-end mb-4">
                  <i class="cil-money icon icon-xxl"></i>
                </div>
                <div class="fs-4 fw-semibold">{{ \Helper::millionFormat($budgets) }}</div><small class="text-medium-emphasis text-uppercase fw-semibold">งบประมาณทั้งหมด</small>
                <div class="progress progress-thin mt-3 mb-0">
                  <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-3 col-md-3 col-lg-2">
            <div class="card">
              <div class="card-body">
                <div class="text-medium-emphasis text-end mb-4">
                  <i class="cil-building icon icon-xxl"></i>
                </div>
                <div class="fs-4 fw-semibold">{{ $projects }}</div><small class="text-medium-emphasis text-uppercase fw-semibold">โครงการ/งานประจำ</small>
                <div class="progress progress-thin mt-3 mb-0">
                  <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-3 col-md-3 col-lg-2">
            <div class="card">
              <div class="card-body">
                <div class="text-medium-emphasis text-end mb-4">
                  <i class="cil-description icon icon-xxl"></i>
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
        <div class="row mb-3">
          <div class="col-sm-4 col-md-4 col-lg-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title fs-5 fw-semibold">งบประมาณ แยกตามปีงบประมาณ</div>
                <div id="chart-budget-div" class="chartdiv"></div>
              </div>
            </div>
          </div>

          <div class="col-sm-4 col-md-4 col-lg-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title fs-5 fw-semibold">โครงการ/งานประจำ แยกตามปีงบประมาณ</div>
                <div id="chart-project-div" class="chartdiv"></div>
              </div>
            </div>
          </div>

          <div class="col-sm-4 col-md-4 col-lg-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title fs-5 fw-semibold">สัญญา แยกตามปีงบประมาณ</div>
                <div id="chart-contract-div" class="chartdiv"></div>
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
        var root = am5.Root.new("chart-budget-div");

        root._logo.dispose();


        // Set themes
        // https://www.amcharts.com/docs/v5/concepts/themes/
        root.setThemes([
          am5themes_Animated.new(root)
        ]);


        // Create chart
        // https://www.amcharts.com/docs/v5/charts/xy-chart/
        var chart = root.container.children.push(am5xy.XYChart.new(root, {
          panX: true,
          panY: true,
          wheelX: "panX",
          wheelY: "zoomX",
          pinchZoomX: true
        }));

        // Add cursor
        // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
        var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
        cursor.lineY.set("visible", false);


        // Create axes
        // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
        var xRenderer = am5xy.AxisRendererX.new(root, {
          minGridDistance: 30
        });
        xRenderer.labels.template.setAll({
          rotation: -90,
          centerY: am5.p50,
          centerX: am5.p100,
          paddingRight: 15
        });

        var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
          maxDeviation: 0.3,
          categoryField: "fiscal_year",
          renderer: xRenderer,
          tooltip: am5.Tooltip.new(root, {})
        }));

        var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
          maxDeviation: 0.3,
          renderer: am5xy.AxisRendererY.new(root, {})
        }));


        // Create series
        // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
        var series = chart.series.push(am5xy.ColumnSeries.new(root, {
          name: "Series 1",
          xAxis: xAxis,
          yAxis: yAxis,
          valueYField: "total",
          sequencedInterpolation: true,
          categoryXField: "fiscal_year",
          tooltip: am5.Tooltip.new(root, {
            labelText: "{valueY}"
          })
        }));

        series.columns.template.setAll({
          cornerRadiusTL: 5,
          cornerRadiusTR: 5
        });
        series.columns.template.adapters.add("fill", function(fill, target) {
          return chart.get("colors").getIndex(series.columns.indexOf(target));
        });

        series.columns.template.adapters.add("stroke", function(stroke, target) {
          return chart.get("colors").getIndex(series.columns.indexOf(target));
        });


        // Set data
        var data = {!! $budget_groupby_fiscal_years !!}

        xAxis.data.setAll(data);
        series.data.setAll(data);


        // Make stuff animate on load
        // https://www.amcharts.com/docs/v5/concepts/animations/
        series.appear(1000);
        chart.appear(1000, 100);

      }); // end am5.ready()
    </script>
    <script>
      am5.ready(function() {

        // Create root element
        // https://www.amcharts.com/docs/v5/getting-started/#Root_element
        var root = am5.Root.new("chart-project-div");

        root._logo.dispose();


        // Set themes
        // https://www.amcharts.com/docs/v5/concepts/themes/
        root.setThemes([
          am5themes_Animated.new(root)
        ]);


        // Create chart
        // https://www.amcharts.com/docs/v5/charts/xy-chart/
        var chart = root.container.children.push(am5xy.XYChart.new(root, {
          panX: true,
          panY: true,
          wheelX: "panX",
          wheelY: "zoomX",
          pinchZoomX: true
        }));

        // Add cursor
        // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
        var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
        cursor.lineY.set("visible", false);


        // Create axes
        // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
        var xRenderer = am5xy.AxisRendererX.new(root, {
          minGridDistance: 30
        });
        xRenderer.labels.template.setAll({
          rotation: -90,
          centerY: am5.p50,
          centerX: am5.p100,
          paddingRight: 15
        });

        var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
          maxDeviation: 0.3,
          categoryField: "fiscal_year",
          renderer: xRenderer,
          tooltip: am5.Tooltip.new(root, {})
        }));

        var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
          maxDeviation: 0.3,
          renderer: am5xy.AxisRendererY.new(root, {})
        }));


        // Create series
        // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
        var series = chart.series.push(am5xy.ColumnSeries.new(root, {
          name: "Series 1",
          xAxis: xAxis,
          yAxis: yAxis,
          valueYField: "total",
          sequencedInterpolation: true,
          categoryXField: "fiscal_year",
          tooltip: am5.Tooltip.new(root, {
            labelText: "{valueY}"
          })
        }));

        series.columns.template.setAll({
          cornerRadiusTL: 5,
          cornerRadiusTR: 5
        });
        series.columns.template.adapters.add("fill", function(fill, target) {
          return chart.get("colors").getIndex(series.columns.indexOf(target));
        });

        series.columns.template.adapters.add("stroke", function(stroke, target) {
          return chart.get("colors").getIndex(series.columns.indexOf(target));
        });


        // Set data
        var data = {!! $project_groupby_fiscal_years !!}

        xAxis.data.setAll(data);
        series.data.setAll(data);


        // Make stuff animate on load
        // https://www.amcharts.com/docs/v5/concepts/animations/
        series.appear(1000);
        chart.appear(1000, 100);

      }); // end am5.ready()
    </script>
    <script>
      am5.ready(function() {

        // Create root element
        // https://www.amcharts.com/docs/v5/getting-started/#Root_element
        var root = am5.Root.new("chart-contract-div");
        root._logo.dispose();


        // Set themes
        // https://www.amcharts.com/docs/v5/concepts/themes/
        root.setThemes([
          am5themes_Animated.new(root)
        ]);


        // Create chart
        // https://www.amcharts.com/docs/v5/charts/xy-chart/
        var chart = root.container.children.push(am5xy.XYChart.new(root, {
          panX: true,
          panY: true,
          wheelX: "panX",
          wheelY: "zoomX",
          pinchZoomX: true
        }));

        // Add cursor
        // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
        var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
        cursor.lineY.set("visible", false);


        // Create axes
        // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
        var xRenderer = am5xy.AxisRendererX.new(root, {
          minGridDistance: 30
        });
        xRenderer.labels.template.setAll({
          rotation: -90,
          centerY: am5.p50,
          centerX: am5.p100,
          paddingRight: 15
        });

        var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
          maxDeviation: 0.3,
          categoryField: "fiscal_year",
          renderer: xRenderer,
          tooltip: am5.Tooltip.new(root, {})
        }));

        var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
          maxDeviation: 0.3,
          renderer: am5xy.AxisRendererY.new(root, {})
        }));


        // Create series
        // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
        var series = chart.series.push(am5xy.ColumnSeries.new(root, {
          name: "Series 1",
          xAxis: xAxis,
          yAxis: yAxis,
          valueYField: "total",
          sequencedInterpolation: true,
          categoryXField: "fiscal_year",
          tooltip: am5.Tooltip.new(root, {
            labelText: "{valueY}"
          })
        }));

        series.columns.template.setAll({
          cornerRadiusTL: 5,
          cornerRadiusTR: 5
        });
        series.columns.template.adapters.add("fill", function(fill, target) {
          return chart.get("colors").getIndex(series.columns.indexOf(target));
        });

        series.columns.template.adapters.add("stroke", function(stroke, target) {
          return chart.get("colors").getIndex(series.columns.indexOf(target));
        });


        // Set data
        var data = {!! $contract_groupby_fiscal_years !!}

        xAxis.data.setAll(data);
        series.data.setAll(data);


        // Make stuff animate on load
        // https://www.amcharts.com/docs/v5/concepts/animations/
        series.appear(1000);
        chart.appear(1000, 100);

      }); // end am5.ready()
    </script>
  </x-slot:javascript>
</x-app-layout>
