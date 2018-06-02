@extends('cp.layouts.app')
@section('active-main-menu-setup', 'opened')
@section('title')
	Restaurant Type: @yield('section-title')
@endsection

@section ('appheadercss')
	@yield('section-css')
@endsection


@section ('appbottomjs')
	@yield('section-js')
@endsection

@section ('page-content')
	<header class="page-content-header">
		<div class="container-fluid">
			<div class="tbl">
				<div class="tbl-row">
					<div class="tbl-cell">
						<h3>Restaurant Type </h3> 
					</div>
					<div class="tbl-cell tbl-cell-action">
						<button onclick="create()"  class="tabledit-delete-button btn btn-sm btn-primary" style="float: none;"><span class="fa fa-plus"></span></button>
					</div>
				</div>
			</div>
		</div>
	</header>
	<div class="container-fluid">
		<div class="box-typical box-typical-padding">
			@yield('section-content')
		</div>	
	</div>

@endsection