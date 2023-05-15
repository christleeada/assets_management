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
  body {
    overflow: hidden;
    height: 100%;
  }
</style>

<x-app-layout>
<div class="row">
  <div class="tile_count">
    <div class="row">
      <div class="col tile_stats_count">
        <span class="count_top"><i class="fa fa-bar-chart"></i> Total Assets</span>
        <div class="count">{{ $totalstocks }}</div>
      </div>

      <div class="col tile_stats_count">
        <span class="count_top"><i class="fa fa-desktop"></i> PC</span>
        <div class="count green">{{ $countPC }}</div>
      </div>

      <div class="col tile_stats_count">
        <span class="count_top"><i class="fa fa-laptop"></i> Laptop</span>
        <div class="count">{{ $countLaptop }}</div>
      </div>

      <div class="col tile_stats_count">
        <span class="count_top"><i class="fa fa-tablet"></i> Tablet</span>
        <div class="count">{{ $countTab }}</div>
      </div>

      <div class="col tile_stats_count">
        <span class="count_top"><i class="fas fa-mouse"></i> Peripherals</span>
        <div class="count">{{ $countComPher }}</div>
      </div>
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

        <canvas id="myChart" style="width:100%;max-width:700px"></canvas>

        <script>
          var xValues = ["Apple", "Lenovo", "Dell", "Samsung", "Asus", "HP", "Razer", "Toshiba", "Acer", "Microsoft", "Fujitsu", "VAIO", "Others"];
        var yValues = [
        <?php echo $brandCounts['Apple'] ?? 0; ?>,
        <?php echo $brandCounts['Lenovo'] ?? 0; ?>,
        <?php echo $brandCounts['Dell'] ?? 0; ?>,
        <?php echo $brandCounts['Samsung'] ?? 0; ?>,
        <?php echo $brandCounts['Asus'] ?? 0; ?>,
        <?php echo $brandCounts['HP'] ?? 0; ?>,
        <?php echo $brandCounts['Razer'] ?? 0; ?>,
        <?php echo $brandCounts['Toshiba'] ?? 0; ?>,
        <?php echo $brandCounts['Acer'] ?? 0; ?>,
        <?php echo $brandCounts['Microsoft'] ?? 0; ?>,
        <?php echo $brandCounts['Fujitsu'] ?? 0; ?>,
        <?php echo $brandCounts['VAIO'] ?? 0; ?>,
        <?php echo $brandCounts['Others'] ?? 0; ?>
    ];
    var barColors = ["#4C3A51", "#1D267D", "#16003B", "#570530", "brown", "cyan", "green", "black", "orange", "purple", "yellow", "pink", "#2E4F4F"];

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
  

  


  
  
</x-app-layout>

