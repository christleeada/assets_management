<tr class="even pointer">
  <td class=" ">
    <select name="stock_id" class="form-control" id="item">
      <option>Select Item</option>
      @foreach ($stocks as $stock)
      <option value="{{ $stock->id }}" {{ old('stock_id', isset($inventory->stock_id) ? $stock->stock_id : '') == $stock->id ? 'selected' : '' }}>{{ $stock->item_name }}</option>
      @endforeach
    </select>
  
  <td class=" ">
    <div class="btn-group">
    </div>
  </td>
</tr>






