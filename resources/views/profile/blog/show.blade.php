@extends('profile.layouts.app')

@section('content')

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="post-item">
				<div class="post-inner">
					<div class="post-head clearfix">
						<div class="col-md-12">
							<div class="detail">
								<h2 class="handle text-center">{{$blogs->title}}</h2>
								<div class="post-meta">
								<div class="asker-meta">
									<span>{{date('j F Y', strtotime($blogs->created_at))}}</span>
									<span>by</span>
									<span><a href="">Admin</a></span>
								</div>
								{{-- <div>
									<label>Share:</label>
										<i class="fa fa-twitter"></i>
										<i class="fa fa-instagram"></i>
										<i class="fa fa-reddit"></i>
									<div class="pull-right" style="font-size: 15px;">
									  <span class="btn btn-default btn-xs" id="{{$posts->id}}-count">{{$posts->likes()->count()}} Likes</span>
					                  <span style="margin-right: 10px;" class="btn btn-default btn-xs {{$posts->YouLiked()?"liked":""}}" onclick="postLike('{{$posts->id}}', this)"><i class="fa fa-thumbs-up"></i> Like</span>
					                </div>
								</div> --}}
								<div class="tags">
									@foreach($blogs->tags as $tag)
									   <span class="label label-success"># {{$tag->name}}</span>
									@endforeach
								</div>
								{{-- <div class="kategori">
									<span class="label label-default pull-right" style="font-size: 12px;">{{$posts->category->name}}</span>
								</div> --}}
								<hr>
							</div>
						</div>
					</div>
						<div class="col-md-12">
							<div class="avatar_show text-center"><a href="#"><img src="{{asset('blog_images/'.$blogs->image)}}" style="max-height: 350px; max-width: 525px"></a></div>
								<br><br>
							<div class="post-content">
								<p>{!!$blogs->content!!}</p>
							</div>
						</div>
					</div>
				</div>
			</div>

					<hr> <!-- start comment -->
				<h4>Comment:</h4>
					<div class="panel with-nav-tabs panel-default">
						<div class="panel-heading">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#tab1" data-toggle="tab">All Comment</a></li>
								<li ><a href="#tab3" data-toggle="tab">Disqus</a></li>
							</ul>
						</div>
						{{-- comment --}}
						<div class="panel-body">
							<div class="tab-content">
								<div class="tab-pane fade in active" id="tab1">
									    <!-- Show Comment -->
                                    @forelse($blogs->comments as $comment)
                                    <div class="card" style="margin-left: 20px;">
                                      <div class="card-header" style=" background-color: #2175ff; color: #fff; border-top-right-radius: 0px; border-top-left-radius: 0px; width: 20%;"><i class="fa fa-clock-o" style="color: #eee"></i> <small style="color: #eee">{{$comment->created_at->diffForHumans()}}</small></div> <br>
                                          <div class="card-body" style="background: #f9f9f9; "> 
                                            <div class="row">
                                                <div class="col-md-3" id="img_comment">
                                                  <img src="//a.disquscdn.com/1504815928/images/noavatar92.png" style="border-radius: 90px;">
                                                    <br>
                                                  <div class="comment_user">
                                                      <b>{{$comment->user->name}}</b>
                                                  </div>
                                                </div>
                                                <div class="col-md-8">
                                                  {{$comment->content}}
                                                </div>
                                            </div>
                                          </div>
                                          <div class="card-footer link_a">
                                              <div class="info_comment">
                                                <a data-toggle="collapse" href="#{{$comment->id}}-collapse1info"><i class="fa fa-info-circle"></i> Info</a>
                                              </div>
                                              <div class="reply_comment">
                                                  <a data-toggle="collapse" href="#{{$comment->id}}-collapse1reply"><i class="fa fa-comment-o"></i> Reply</a>
                                              </div>
                                          </div>
                                          <div id="{{$comment->id}}-collapse1info" class="card-collapse collapse">
                                            <div class="card-body">*Klik 'Reply' untuk melihat atau membuat komentar balasan.</div> 
                                          </div>
                                          <div id="{{$comment->id}}-collapse1reply" class="card-collapse collapse">
                                            <div class="card-body">
                                              <!-- forelse reply-->
                                            @forelse($comment->reply_comments as $reply)
                                              <div class="card">
                                                <div class="card-header" style="background-color: #2175ff; color: #fff; border-top-right-radius: 0px; border-top-left-radius: 0px;"><i class="fa fa-clock-o" style="color: #eee"></i> <small style="color: #eee"> {{$reply->created_at->diffForHumans()}} </small></div>
                                                <div class="card-body" style="background: #f9f9f9;"> 
                                                    <div class="row">
                                                      <div class="col-md-8">
                                                        {{$reply->content}}
                                                      </div>
                                                      <div class="col-md-3" id="img_comment_reply">
                                                        <img src="//a.disquscdn.com/1504815928/images/noavatar92.png" style="border-radius: 90px;">
                                                            <br>
                                                        <div class="comment_user">
                                                            <b>{{$reply->user->name}}</b>
                                                        </div>
                                                      </div>
                                                    </div>
                                                </div>
                                              </div>
                                              @empty
                                                <br>
                                              <p class="text-danger" style="padding-left: 10px;">*No Reply in This Comment</p>
                                              @endforelse
                                            </div>
                                            <div class="panel-body" style="    border-top: 1px solid #eee;">
                                              <form action="{{route('admin.replyComment.store', $comment->id)}}" method="post" style="    padding: 0 16px;">
                                                  {{csrf_field()}}
                                                <div class="form-group">
                                                  <textarea name="content" class="form-control" id="input_reply" placeholder="Reply here.."></textarea>    
                                                </div>
                                                <button class="btn btn-success" type="submit">Submit</button>
                                              </form>
                                            </div>
                                        </div>
                                    </div>  <br>
                                          <!-- endforelse comment -->
                                    @empty
                                      <br>
                                      <p class="text-danger" style="padding-left: 10px;">*No Comment in This Thread</p>
                                    @endforelse
								</div>

									<div class="tab-pane" id="tab2">
										<form action="{{route('admin.store.comment',$blogs->id)}}" method="post">
											{{csrf_field()}}
											<label>Tulis Komentar: </label>
											<div class="form-group">
												<textarea class="form-control" type="text" name="comment" placeholder="tulis komentar anda disini........."></textarea>
											</div>
											<br>
											<button class="btn btn-success" type="submit">Kirim</button>
										</form>
									</div>

									<div class="tab-pane" id="tab3">
										<div id="disqus_thread"></div>
											<script>

											/**
											*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
											*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
											/*
											var disqus_config = function () {
											this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
											this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
											};
											*/
											(function() { // DON'T EDIT BELOW THIS LINE
											var d = document, s = d.createElement('script');
											s.src = 'https://dagelsteam.disqus.com/embed.js';
											s.setAttribute('data-timestamp', +new Date());
											(d.head || d.body).appendChild(s);
											})();
											</script>
											<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
									</div>

							</div>
						</div>			
					</div>
					 <!-- end comment -->
		</div> <!-- end col md 9 -->
					
				<a href="{{ route('admin.blog.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>

			</div>
		</div>

@stop