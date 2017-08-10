{{-- This is the homepage blade --}}
@extends('master')

@section('content')
<!-- Main content -->


<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title"><strong>Category Result</strong></h3>
				</div><!-- /.box-header -->
				<div class="box-body">					
					<table id="" class="table table-bordered table-striped">
						<thead>
							<tr class="category-reslut-title">
								<th class="category-reslut-name">Subcategory Name</th>
								<th class="category-reslut-number">Number of Result</th>
							</tr>
						</thead>
						<tbody class="category-result-info">
							@foreach($category_result as $key => $value)
							<tr class="content-info">
								<td class="category-reslut-name"><a href="/product/subcategory-search/{{$category}}/{{$key}}">{{$key}}</a></td>								
								<td class="category-reslut-number">{{$value}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>					

				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!-- /.col -->
	</div><!-- /.row -->
</section><!-- /.content -->
@stop

@section('script')

@stop