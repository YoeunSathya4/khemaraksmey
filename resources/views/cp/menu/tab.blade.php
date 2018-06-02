@extends('cp.menu.main')
@section ('section-css')
	@yield ('tab-css')
@endsection

@section ('section-js')
	@yield ('tab-js')
@endsection

@section ('section-content')
	
			
	<section class="tabs-section">
		<div class="tabs-section-nav tabs-section-nav-icons">
			<div class="tbl">
				<ul class="nav" role="tablist">
					<li class="nav-item">
						
						<a class="nav-link @yield ('tab-active-edit')" onclick="window.location.href='{{ route('cp.menu.edit', $id) }}'" href="#" role="tab" data-toggle="tab">
							<span class="nav-link-in">
								<i class="fa fa-user"></i> Overview
							</span>
						</a>
					</li>
					
					
					
					<li class="nav-item">
						<a class="nav-link @yield ('tab-active-size')" onclick="window.location.href='{{ route('cp.menu.size', $id) }}'" href="#" role="tab" data-toggle="tab">
							<span class="nav-link-in">
								<i class="fa fa-th-large"></i> Sizes
							</span>
						</a>
					</li>
					
					<li class="nav-item">
						<a class="nav-link @yield ('tab-active-photo')" onclick="window.location.href='{{ route('cp.menu.image.index', $id) }}'" href="#" role="tab" data-toggle="tab">
							<span class="nav-link-in">
								<i class="fa fa-picture-o"></i> Images
							</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link @yield ('tab-active-type')" onclick="window.location.href='{{ route('cp.menu.categories', $id) }}' " href="#" role="tab" data-toggle="tab">
							<span class="nav-link-in">
								<i class="fa fa-sticky-note-o"></i> Categories
							</span>
						</a>
					</li>
				</ul>
			</div>
		</div><!--.tabs-section-nav-->

		<div class="tab-content">
			<div role="tabpanel" class="tab-pane fade in active">
				<div id="tab-content-cnt" class="container-fluid">
					@yield ('tab-content')
				</div>
			</div>
		</div><!--.tab-content-->
	</section><!--.tabs-section-->
				
	


@endsection