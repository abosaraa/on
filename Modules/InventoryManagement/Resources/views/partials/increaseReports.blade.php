@foreach($increaseProductReport as $product)
<tr id="{{$loop->iteration}}">
    @php
        $vars = $variations->where('id',$product->pivot->variation_id)->first();
        $varname='';
        $varname = ($varname == 'DUMMY'?'':' ( '. $vars->name .' )') ;
        $skuAndSubSku = ($product->type =='single'?$vars->sku  : $vars->sub_sku) ;
    @endphp
    <td>{{$product->name . $varname}}</td>
    <td>{{$skuAndSubSku}}</td>
    <td>{{intval($product->pivot->qty_before)}}</td> 
    <td>{{$product->pivot->amount_after_inventory}}</td>
    <td>{{$product->pivot->Amount_difference}}</td>
</tr>
<i class="fa-thin fa-badge-check"></i>
@endforeach
