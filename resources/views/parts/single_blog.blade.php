
            <div class="col-lg-6 col-md-6 col-xl-4 mb-50px">
                <div class="single-blog">
                    <div class="blog-image">
                        <a href="{{ route('blog.details', $post->id) }}"><img src="{{ asset('uploads/post_img') }}/{{$post->post_image}}" class="img-responsive w-100" alt=""></a>
                    </div>
                    <div class="blog-text">
                        <div class="blog-athor-date">
                            <a class="blog-date height-shape" href=""><i class="fa fa-calendar" aria-hidden="true"></i> {{ $post->created_at->format('d-M-y') }}</a>
                        </div>
                        <h5 class="blog-heading"><a class="blog-heading-link" href="{{ route('blog.details', $post->id) }}">{{ $post->post_title }}</a></h5>
                        <p>{!! \Illuminate\Support\Str::limit($post->post_des, 50) !!}</p>
                        <a href="{{ route('blog.details', $post->id) }}" class="btn btn-primary blog-btn"> Read More<i class="fa fa-arrow-right ml-5px" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
