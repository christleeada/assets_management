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
<!-- <style>
  body {
    overflow: auto;
    height: 100%;
  }
</style> -->

<x-app-layout>


  <div class="row">
    <div class="col-3">
      <a href="{{route('item.index')}}" class="btn btn-primary btn-block">
        <i class="fa fa-archive fa-2x"></i>
        <span class="d-block mt-2">Total Assets</span>
        <span class="count">{{ $totalstocks }}</span>
      </a>
    </div>

    <div class="col-3">
      <a href="{{route('item.index')}}" class="btn btn-success btn-block">
        <i class="fa fa-desktop fa-2x"></i>
        <span class="d-block mt-2">PC</span>
        <span class="count">{{ $countPC }}</span>
      </a>
    </div>

    <div class="col-3">
      <a href="{{route('item.index')}}" class="btn btn-info btn-block">
        <i class="fa fa-laptop fa-2x"></i>
        <span class="d-block mt-2">Laptop</span>
        <span class="count">{{ $countLaptop }}</span>
      </a>
    </div>

    <div class="col-3">
      <a href="{{route('item.index')}}" class="btn btn-warning btn-block">
        <i class="fa fa-tablet fa-2x"></i>
        <span class="d-block mt-2">Tablet</span>
        <span class="count">{{ $countTab }}</span>
      </a>
    </div>


  </div>


  <div class="row">
    <div class="col-md-8">
      <div class="dashboard_graph">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
        <div class="row x_title">
          <div class="col-md-6">
            <h2> Total Assets of Each Brand</h2>
          </div>
        </div>

        <canvas id="myChart" style="width: 100%; max-width: 850px"></canvas>
        <script>
          var xValues = ["Apple", "Lenovo", "Dell", "Samsung", "Asus", "HP", "Razer", "Toshiba", "Acer", "Microsoft", "Fujitsu", "VAIO", "Alienware", "Others"];
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
            <?php echo $brandCounts['Alienware'] ?? 0; ?>,
            <?php echo $brandCounts['Others'] ?? 0; ?>
          ];
          var barColors = ["#4C3A51", "#1D267D", "#16003B", "#570530", "brown", "cyan", "green", "black", "orange", "purple", "yellow", "#C060A1", "#2E4F4F", "#647E68"];

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
                text: "Graph"
              }
            }
          });
        </script>

        <div class="clearfix"></div>
      </div>
    </div>

    <div class="col-md-4">
      <div>
        <h2 class="text-center mb-4">Recently Added</h2>
      </div>
      <div style="max-height: 300px; overflow-y: scroll;">

        <div>

          <ul>
            <?php
            $recentlyAdded = DB::table('items')
              ->select('id', 'image', 'item_name', 'description', 'created_at')
              ->orderBy('created_at', 'desc')
              ->limit(6) // Adjust the number of recently added items to display
              ->get();

            foreach ($recentlyAdded as $item) {
            ?>
              <li class="list-group-item" onclick="window.location='{{ route('item.show', $item->id) }}'" data-item-id="{{ $item->id }}">
                <div class="row">

                  
                    <img src="{{ asset('uploads/image/' . $item->image) }}" alt="Item Image" class="rounded mx-auto d-block" style="width:100px;height:100px;">
                    <div class="item-details">
                      <h6>{{ $item->item_name }}</h6>
                      <p>{{ $item->description }}</p>
                      <span class="created-at">{{ $item->created_at }}</span>
                    </div>
                  
                </div>
              </li>
            <?php
            }
            ?>
          </ul>
        </div>
      </div>
    </div>

  </div>

  <div class="row">
    <div class="col-md-8">
      <table id="itemTable" >
        <h2>Defective/Service Required Assets</h2>
        <thead>
          <tr>
            <th>Image</th>
            <th>Item Name</th>
            <th>Remarks</th>
            <th>Updated At</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $itemsWithStatus = DB::table('items')
            ->join('statuses', 'items.post_status_id', '=', 'statuses.id')
            ->select('items.id', 'items.image', 'items.item_name', 'items.remarks', 'items.updated_at')
            ->whereIn('statuses.status', ['Need Maintenance', 'Disposed', 'Defective'])
            ->orderBy('items.created_at', 'desc')
            ->limit(3) // Adjust the number of items to display
            ->get();


          foreach ($itemsWithStatus as $item) {
          ?>
            <tr onclick="window.location='{{ route('item.show', $item->id) }}'" data-item-id="{{ $item->id }}">
              <td>
                <img src="{{ asset('uploads/image/' . $item->image) }}" alt="Item Image" class="rounded mx-auto d-block" style="width:100px;height:100px;">
              </td>
              <td>{{ $item->item_name }}</td>
              <td>{{ $item->remarks }}</td>
              <td>{{ $item->updated_at }}</td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>
    
  </div>




</x-app-layout>

@include('layouts.scripts.items-script')