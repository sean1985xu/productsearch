{{-- This is the homepage blade --}}
@inject('request', 'Illuminate\Http\Request')
@extends('master')

@section('content')
<!-- Main content -->

<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title"><strong>Category Input</strong></h3>
				</div><!-- /.box-header -->
				<div class="box-body" >
					<div>
						<p>Please enter a category name</p>
						{!! Form::open(array('url' => 'product/category-search', 'class' => 'form','method' => 'GET')) !!}
						<div class="input-group">
							<input name="category" type="text" class="form-control category-input" placeholder="Category Name">
							<span class="input-group-btn">
								<button class="btn btn-primary" type="submit">Submit</button>
							</span>
						</div>
						{!! Form::close() !!}
					</div>					
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!-- /.col -->
	</div><!-- /.row -->
</section><!-- /.content -->

@stop


@section('script')



@stop