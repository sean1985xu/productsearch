{{-- This is the homepage blade --}}
@extends('master')

@section('content')
<!-- Main content -->


<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title"><strong>Product Result</strong></h3>
				</div><!-- /.box-header -->
				<div class="box-body">					
					<table id="" class="table table-bordered table-striped">
						<thead>
							<tr class="category-reslut-title">
								<th class="category-reslut-name">Product Name</th>
								<th class="category-reslut-number">Supplier Name</th>
								<th class="category-reslut-number">Store Product Code</th>
								<th class="category-reslut-number">Category</th>
								<th class="category-reslut-number">Subcategory</th>
							</tr>
						</thead>
						<tbody class="category-result-info">
							@foreach($product_result as $key => $product)
							@if(is_numeric($key))
							<tr class="content-info">
								<td class="activity-date">{{$product->ProductName ?? ""}}</td>								
								<td class="activity-owner-type">{{$product->SupplierName ?? ""}}</td>
								<td class="activity-owner-type">{{$product->StoreProductCode ?? ""}}</td>
								<td class="activity-owner-type">{{$product->MasterCategory ?? ""}}</td>
								<td class="activity-owner-type">{{$product->SubCategory ?? ""}}</td>
							</tr>
							@endif
							@endforeach
						</tbody>
					</table>					
					{{-- Image Collection List Pagination --}}
	                @if ($product_result['all_pages'] > 1)
	                <nav class="pagination-wrap">
	                <ul class="pagination">
	                @if ($product_result['current_page'] > 1)
	                  <li class="pagin-btn pagin-back">
	                    <a href="/image/collections/all/page/1" aria-label="First">
	                      <span aria-hidden="true">&laquo; First</span>
	                    </a>
	                  </li>
	                  <li class="pagin-btn pagin-back">
	                    <a href="/image/collections/all/page/{{$product_result['current_page']-1}}" aria-label="Previous">
	                      <span aria-hidden="true">&laquo; Back</span>
	                    </a>
	                  </li>
	                  @endif
	                  @for ($i = $product_result['current_range_start']; $i <= $product_result['current_range_end']; $i++)
	                  <li @if($i == $product_result['current_page']) class="active" @endif><a href="/product/subcategory-search/{{$category}}/{{$subcategory}}/pages/{{$i}}">{{$i}}</a></li>
	                  @endfor
	                  @if ($product_result['current_page'] < $product_result['all_pages'])
	                  <li class="pagin-btn pagin-next">
	                    <a href="/image/collections/all/page/{{ $product_result['current_page']+1 }}" aria-label="Next">
	                      <span aria-hidden="true">Next &raquo;</span>
	                    </a>
	                  </li>
	                  <li class="pagin-btn pagin-next">
	                    <a href="/image/collections/all/page/{{ $product_result['all_pages'] }}" aria-label="Last" title="{{ $product_result['all_pages'] }}">
	                      <span aria-hidden="true">Last &raquo;</span>
	                    </a>
	                  </li>
	                  @endif
	                </ul>
	              </nav>
	              @endif
	              {{-- End Image Collection List Pagination --}}
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!-- /.col -->
	</div><!-- /.row -->
</section><!-- /.content -->
@stop

@section('script')

@stop