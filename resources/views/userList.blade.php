{{-- This is the homepage blade --}}
@extends('master')

@section('content')
<!-- Main content -->


<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title"><strong>User Result</strong></h3>
				</div><!-- /.box-header -->
				<div class="box-body">					
					<table id="" class="table table-bordered table-striped">
						<thead>
							<tr class="category-reslut-title">
								<th><a href="/user/1/firstName">First Name</a></th>
								<th><a href="/user/1/lastName">Last Name</a></th>
								<th>Email</th>
								<th>Website Address</th>
							</tr>
						</thead>
						<tbody class="category-result-info">
							@foreach($userList as $key => $user)
							@if(is_numeric($key))
							<tr class="content-info">
								<td>{{$user['firstName']}}</td>								
								<td>{{$user['lastName']}}</td>
								<td><a href="{{$user['emailURL']}}">{{$user['email']}}</a></td>
								<td><a href="{{$user['websiteURL']}}">{{$user['website']}}</a></td>
							</tr>
							@endif
							@endforeach
						</tbody>
					</table>					
					{{-- User List Pagination --}}
	                @if ($userList['all_pages'] > 1)
	                <nav class="pagination-wrap">
	                <ul class="pagination">
	                @if ($userList['current_page'] > 1)
	                  <li class="pagin-btn pagin-back">
	                    <a href="/user/1/{{$userList['orderBy']}}" aria-label="First">
	                      <span aria-hidden="true">&laquo; First</span>
	                    </a>
	                  </li>
	                  <li class="pagin-btn pagin-back">
	                    <a href="/user/{{$userList['current_page']-1}}/{{$userList['orderBy']}}" aria-label="Previous">
	                      <span aria-hidden="true">&laquo; Back</span>
	                    </a>
	                  </li>
	                  @endif
	                  @for ($i = $userList['current_range_start']; $i <= $userList['current_range_end']; $i++)
	                  <li @if($i == $userList['current_page']) class="active" @endif><a href="/user/{{$i}}/{{$userList['orderBy']}}">{{$i}}</a></li>
	                  @endfor
	                  @if ($userList['current_page'] < $userList['all_pages'])
	                  <li class="pagin-btn pagin-next">
	                    <a href="/user/{{ $userList['current_page']+1 }}/{{$userList['orderBy']}}" aria-label="Next">
	                      <span aria-hidden="true">Next &raquo;</span>
	                    </a>
	                  </li>
	                  <li class="pagin-btn pagin-next">
	                    <a href="/user/{{ $userList['all_pages'] }}/{{$userList['orderBy']}}" aria-label="Last" title="{{ $userList['all_pages'] }}">
	                      <span aria-hidden="true">Last &raquo;</span>
	                    </a>
	                  </li>
	                  @endif
	                </ul>
	              </nav>
	              @endif
	              {{-- End User List Pagination --}}
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!-- /.col -->
	</div><!-- /.row -->
</section><!-- /.content -->
@stop

@section('script')

@stop