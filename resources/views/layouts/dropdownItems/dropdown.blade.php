<tr class="even pointer">
    <td class=" ">
    <select name="stock_id" class="form-control" id="item">
        <option>Select Item</option>
        @foreach ($stocks as $stock)
        <option value="{{ $stock->id }}" {{ old('stock_id', isset($inventory->stock_id) ? $stock->stock_id : '') == $stock->id ? 'selected' : '' }}>{{ $stock->item_name }}</option>
        @endforeach
    </select>
    </td>
    <td class=" ">
    <input type="text" name="description" class="form-control" id="location_name">
    </td>
    <td class=" ">
    <input type="text" name="location_name" class="form-control" id="location_name">
    </td>
    <td class=" ">
    <input type="text" name="location_name" class="form-control" id="location_name">
    </td>
    <td class=" ">
    <input type="text" name="location_name" class="form-control" id="location_name">
    </td>
    <td class=" ">
    <input type="text" name="location_name" class="form-control" id="location_name">
    </td>
    <td class=" ">
        <div class="btn-group">
            
        </div>
    </td>
    </td>
</tr>