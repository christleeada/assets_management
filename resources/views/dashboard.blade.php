
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
    <div class="col-4">
        <a href="{{route('item.index')}}" class="btn btn-primary btn-block d-flex align-items-center justify-content-between">
            <div class="text-left">
                <span class="d-block mt-2">Total Assets</span>
                <span class="ml-auto count">{{ $totalstocks }}</span>
            </div>
            <span class="ml-2">
                <i class="fa fa-archive fa-2x"></i>
            </span>
        </a>
    </div>

    <div class="col-4">
        <a href="{{route('item.deletedAssets')}}" class="btn btn-success btn-block d-flex align-items-center justify-content-between">
            <div class="text-left">
                <span class="d-block mt-2">Deleted Assets</span>
                <span class="ml-auto count">{{ $countDeleted}}</span>
            </div>
            <span class="ml-2">
                <i class="fa fa-trash fa-2x"></i>
            </span>
        </a>
    </div>

    <div class="col-4">
        <a href="{{route('user.index')}}" class="btn btn-info btn-block d-flex align-items-center justify-content-between">
            <div class="text-left">
                <span class="d-block mt-2">Total Users</span>
                <span class="ml-auto count">{{ $userCount }}</span>
            </div>
            <span class="ml-2">
                <i class="fa fa-users fa-2x"></i>
            </span>
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
  <div class="row x_title">
    <div class="col-md-6">
      <h2>Recently Added</h2>
    </div>
  </div>
  <div style="max-height: 450px; overflow-y: scroll;">
    <div>
      <div class="card-list">
        <?php
        foreach ($recentlyAdded as $item) {
        ?>
          <div class="card" onclick="window.location='{{ route('item.show', $item->id) }}'" data-item-id="{{ $item->id }} ">
            <div class="row g-0">
              <div class="col-md-4">
                <img src="{{ asset('uploads/image/' . $item->image) }}" alt="Item Image" class="card-img">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title">{{ $item->item_name }}</h5>
                  <p class="card-text">{{ $item->description }}</p>
                  <p class="card-text"><small class="text-muted">{{ $item->created_at }}</small></p>
                </div>
              </div>
            </div>
          </div>
        <?php
        }
        ?>
      </div>
    </div>
  </div>
</div>


  </div>

  <div class="row">
  <div class="col-md-8">
    <h2>Defective/Service Required Assets</h2>
    <div class="table-responsive">
      <table class="table table-hover">
        <thead>
          <tr>
            <th></th>
            <th>Asset Name</th>
            <th>Remarks</th>
            <th>Last Updated</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($itemsWithStatus as $item)
            <tr onclick="window.location='{{ route('item.show', $item->id) }}'" data-item-id="{{ $item->id }}">
              <td>
                <img src="{{ asset('uploads/image/' . $item->image) }}" alt="Item Image" class="rounded mx-auto d-block" style="width:60px;height:60px;">
              </td>
              <td>{{ $item->item_name }}</td>
              <td>{{ $item->remarks }}</td>
              <td>{{ $item->updated_at }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>


  
  </div>








</x-app-layout>

@include('layouts.scripts.messages-script')
