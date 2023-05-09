<?php

use Illuminate\Support\Facades\DB;
// Retrieve the total count of items from the database
$totalstocks = DB::table('items')->sum('quantity');

$countPC = DB::table('items')
  ->join('item_categories', 'items.item_category', '=', 'item_categories.id')
  ->where('item_categories.item_category', '=', 'Desktop Computer')
  ->sum('items.quantity');

$countLaptop = DB::table('items')
  ->join('item_categories', 'items.item_category', '=', 'item_categories.id')
  ->where('item_categories.item_category', '=', 'Laptop')
  ->sum('items.quantity');

$countTab = DB::table('items')
  ->join('item_categories', 'items.item_category', '=', 'item_categories.id')
  ->where('item_categories.item_category', '=', 'Tablet')
  ->sum('items.quantity');

$countComPher = DB::table('items')
  ->join('item_categories', 'items.item_category', '=', 'item_categories.id')
  ->where('item_categories.item_category', '=', 'Computer Peripherals')
  ->sum('items.quantity');

$brandCounts = DB::table('items')
  ->whereIn('brand', ["Apple", "Lenovo", "Dell", "Samsung", "Asus", "HP", "Razer", "Others"])
  ->select('brand', DB::raw('SUM(quantity) as count'))
  ->groupBy('brand')
  ->pluck('count', 'brand')
  ->toArray();


?>
<link rel="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" type="text/css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript">
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.2/Chart.min.js"></script>
<style>
  .container {
    width: 70%;
    margin: 15px auto;
  }

  body {
    text-align: center;
    color: green;
  }

  h2 {
    text-align: center;
    font-family: "Verdana", sans-serif;
    font-size: 30px;
  }
</style>

<x-app-layout>
<div class="row" style="display: inline-block;">
  <div class="tile_count">
    <div class="col-md-3 col-sm-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-bar-chart"></i> Total Assets</span>
      <div class="count">{{ $totalstocks }}</div>
    </div>

    <div class="col-md-3 col-sm-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-desktop"></i> PC</span>
      <div class="count green">{{ $countPC }}</div>
    </div>

    <div class="col-md-3 col-sm-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-laptop"></i> Laptop</span>
      <div class="count">{{ $countLaptop }}</div>
    </div>

    <div class="col-md-3 col-sm-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-tablet"></i> Tablet</span>
      <div class="count">{{ $countTab }}</div>
    </div>

    <div class="col-md-3 col-sm-6 tile_stats_count">
      <span class="count_top"><i class="fas fa-mouse"></i> Peripherals</span>
      <div class="count">{{ $countComPher }}</div>
    </div>
  </div>
</div>

  <!-- /top tiles -->

  <div class="row">
    <div class="col-md-12 col-sm-12 ">
      <div class="dashboard_graph">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
        <div class="row x_title">
          <div class="col-md-8">
            <h3>Management Activities <small>Brand of Assets</small></h3>
          </div>
          <div class="col-md-6">

          </div>
        </div>

        <canvas id="myChart" style="width:100%;max-width:800px"></canvas>

        <script>
          var xValues = ["Apple", "Lenovo", "Dell", "Samsung", "Asus", "HP", "Razer", "Others"];
          var yValues = [
            <?php echo $brandCounts['Apple'] ?? 0; ?>,
            <?php echo $brandCounts['Lenovo'] ?? 0; ?>,
            <?php echo $brandCounts['Dell'] ?? 0; ?>,
            <?php echo $brandCounts['Samsung'] ?? 0; ?>,
            <?php echo $brandCounts['Asus'] ?? 0; ?>,
            <?php echo $brandCounts['HP'] ?? 0; ?>,
            <?php echo $brandCounts['Razer'] ?? 0; ?>,
            <?php echo $brandCounts['Others'] ?? 0; ?>
          ];
          var barColors = ["grey", "red", "blue", "orange", "brown", "cyan", "green", "black"];

          new Chart("myChart", {
            type: "bar",
            data: {
              labels: xValues,
              datasets: [{
                backgroundColor: barColors,
                data: yValues
              }]
            },
            options: {
              legend: {
                display: false
              },
              title: {
                display: true,
                text: "Brands"
              }
            }
          });
        </script>


        <div class="clearfix"></div>
      </div>
    </div>

  </div>

  <div class="row">
    <!-- Start to do list -->
    <div class="col-md-6 col-sm-6 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>To Do List <small>Tasks</small></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

              </div>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">


          <ul class="to_do">
            <li>
              <p>
                <input type="checkbox" class="flat"> Buy new computers
              </p>
            </li>
            <li>
              <p>
                <input type="checkbox" class="flat"> Check current computers for errors
              </p>
            </li>
            <li>
              <p>
                <input type="checkbox" class="flat"> Fix the network printer
              </p>
            </li>
            <li>
              <p>
                <input type="checkbox" class="flat"> Create backups for database
              </p>
            </li>
            <li>
              <p>
                <input type="checkbox" class="flat"> Add notification for devices that need maintenance
              </p>


            </li>
          </ul>

        </div>
      </div>
    </div>
    <!-- End to do list -->


  </div>
  </div>
  </div>
</x-app-layout>

<!-- JavaScript to fetch count value and update HTML -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script>
  $(document).ready(function() {
    $.ajax({
      url: '/count-items',
      type: 'GET',
      dataType: 'json',
      success: function(data) {
        $('.count').text(data.count);
      }
    });
  });
</script>