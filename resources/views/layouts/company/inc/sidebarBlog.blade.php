						<!-- Sidebar Start -->
						<div class="col-md-4">
							<div class="blog-sidebar">
							
									<form role="form" enctype="multipart/form-data" method="POST" action="{{ url('article') }}" role="search">
									@csrf
									<div class="search-form">
										<div class="input-group">
											<input type="text" class="form-control" name="keyword" placeholder="@lang('global.Keyword')" value="{{old('keyword')}}">
											<span class="input-group-btn">
												<button type="button" class="btn btn-default">Go</button>
											</span>
										</div>
									</div>
								</form>
								
								<div class="sidebar-widget">
									<h4>@lang('global.Category')</h4>
									<ul class="sidebar-list">
										@foreach($categories as $category)
											<li>
												<a href="{{route('company.article.byCategory',[$category->translation_of,$category->slug])}}">{{$category->name}}<span></span></a>
											</li>
										@endforeach
									</ul>
								</div>
								
								<div class="sidebar-widget">
									<h4>@lang('global.Popular Article')</h4>
									@foreach($artPopulars as $article)
										@if($article->visits>5)									
									<div class="blog-item">
										<div class="post-thumb"><a href="{{route('company.article.detail',[$article->id,$article->slug])}}"><img src="{{asset('storage/uploads/article/'.$article->cover)}}" class="img-responsive" alt=""></a></div>
										<div class="blog-detail">
											<a href="{{route('company.article.detail',[$article->id,$article->slug])}}"><h4>{{ str_limit(strip_tags(ucwords($article->title)), 50) }}</h4></a>
											<div class="post-info">{{date('d M Y', strtotime($article->created_at))}}</div>
										</div>
									</div>
									@endif										
									@endforeach
									<div class="blog-item">
									{{$artPopulars->render()}}
									</div>
								</div>
								
								<div class="sidebar-widget">
									<h4>@lang('global.Recent Article')</h4>
										@foreach($artRecents as $article)
										<div class="blog-item">
											<div class="post-thumb"><a href="{{route('company.article.detail',[$article->id,$article->slug])}}"><img src="{{asset('storage/uploads/article/'.$article->cover)}}" class="img-responsive" alt=""></a></div>
											<div class="blog-detail">
												<a href="{{route('company.article.detail',[$article->id,$article->slug])}}"><h4>{{ str_limit(strip_tags(ucwords($article->title)), 50) }}</h4></a>
												<div class="post-info">{{date('d M Y', strtotime($article->created_at))}}</div>
											</div>
										</div>
									@endforeach
									<div class="blog-item">
										{{$artRecents->render()}}
									</div>									
								</div>
								
							</div>
						</div>
						<!-- End Sidebar Start -->