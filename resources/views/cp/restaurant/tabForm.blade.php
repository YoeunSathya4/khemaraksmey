@extends('cp.restaurant.tab')
@section ('tab-active-about', 'active')

@section ('tab-content')
	
	<section class="box-typical files-manager">
		<nav class="files-manager-side" style="height: auto;">
			<ul class="files-manager-side-list">
				<li><a href="{{ route('cp.restaurant.edit', $id) }}" class="@yield ('about-active-overview')">Overview</a></li>
				<li><a href="{{ route('cp.restaurant.contact', $id) }}" class="@yield ('about-active-contact')">Contact</a></li>
				<li><a href="{{ route('cp.restaurant.categories', $id) }}" class="@yield ('about-active-category')">Categories</a></li>
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