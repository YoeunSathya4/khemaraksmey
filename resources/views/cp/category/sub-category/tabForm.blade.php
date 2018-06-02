@extends('cp.category.tab')
@section ('tab-active-about', 'active')

@section ('tab-content')
	
	<section class="box-typical files-manager">
		<nav class="files-manager-side" style="height: auto;">
			<ul class="files-manager-side-list">
				<li><a href="{{ route('cp.category.sub-category.edit', ['id'=>$id, 'subcategory_id'=>$subcategory_id]) }}" class="@yield ('about-active-overview')">Overview</a></li>
				<li><a href="{{ route('cp.category.sub-category.mainCategory', ['id'=>$id, 'subcategory_id'=>$subcategory_id]) }}" class="@yield ('about-active-main-category')"> Main Category</a></li>
				
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