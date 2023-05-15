<x-app-layout>
    <div class="row">
        <div class="offset-2 col-md-8 col-sm-12">
            <div class="x_panel">
                <div class="x_title text-center">
                    <h2>Asset Details</h2>
                    <div class="clearfix"></div>
                </div>
                
                
                <div class="x_content">
                <div class="text-center">
                <img src="{{ asset('uploads/image/' . $item->image) }}" alt="Item Image"  class="rounded mx-auto d-block" style="width:300px;height:300px;">

                    </div>
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th scope="row">Item Name</th>
                                <td>{{ $item->item_name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Description</th>
                                <td>{{ $item->description }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Category</th>
                                <td>{{ $item->itemCategory->item_category }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Estimated Lifespan</th>
                                <td>{{ $item->itemCategory->estimated_lifespan }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Purchased As</th>
                                <td>{{ $item->purchased_as }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Date Purchased</th>
                                <td>{{ $item->date_purchased }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Status</th>
                                <td>{{ $item->status->status }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    </x-app-layout>