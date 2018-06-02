@extends('cp.restaurant.tab')
@section ('tab-active-about', 'active')

@section ('tab-content')
	
	<section class="box-typical files-manager">
		<nav class="files-manager-side" style="height: auto;">
			<ul class="files-manager-side-list">
				<li><a href="{{ route('cp.restaurant.menu.edit', ['id'=>$id, 'menu_id'=>$menu_id]) }}" class="@yield ('about-active-overview')">Overview</a></li>
				<li><a href="{{ route('cp.restaurant.menu.size', ['id'=>$id, 'menu_id'=>$menu_id]) }}" class="@yield ('about-active-size')">Size</a></li>
				<li><a href="{{ route('cp.restaurant.menu.extra', ['id'=>$id, 'menu_id'=>$menu_id]) }}" class="@yield ('about-active-extra')">Extra</a></li>
			</ul>
		</nav><!--.files-manager-side-->

		<div class="files-manager-panel">
			<div class="files-manager-panel-in">
				<div class="container-fluid">
					@yield ('about')
				</div>
			</div><!--.files-manager-panel-in-->
		</div><!--.files-manager-panels-->
	</section>
	
@endsection