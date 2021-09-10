@extends('frontend.layout.base')

@section('content')
<div class="content-area">
    <div class="animated-sections">
        <!-- Home Subpage -->
        <section data-id="home" class="animated-section start-page">
            <div class="section-content vcentered">

                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="title-block">
                            <h2>{{ $user->name }}</h2>
                            <div class="owl-carousel text-rotation">
                                @foreach ($tagline as $t)
                                <div class="item">
                                    <div class="sp-subtitle">{{ $t->tagline }}</div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!-- End of Home Subpage -->

        <!-- About Me Subpage -->
        <section data-id="about-me" class="animated-section">
            <div class="section-content">
                <div class="page-title">
                    <h2>About <span>Me</span></h2>
                </div>

                <!-- Personal Information -->
                <div class="row">
                    <div class="col-xs-12 col-sm-7">
                        <p>{{ $config->about }}</p>
                    </div>

                    <div class="col-xs-12 col-sm-5">
                        <div class="info-list">
                            <ul>
                                <li>
                                    <span class="title">Address</span>
                                    <span class="value">{{ $config->address }}</span>
                                </li>

                                <li>
                                    <span class="title">E-mail</span>
                                    <span class="value">{{ $config->email }}</span>
                                </li>

                                <li>
                                    <span class="title">Phone</span>
                                    <span class="value">{{ $config->phone }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- End of Personal Information -->

                <div class="white-space-50"></div>


                <!-- End of Services -->

            </div>
        </section>
        <!-- End of About Me Subpage -->


        <!-- Resume Subpage -->

        <section data-id="resume" class="animated-section">
            <div class="section-content">
                <div class="page-title">
                    <h2>Resume</h2>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-7" style="margin-bottom: 50px">

                        <div class="block-title">
                            <h3>Education</h3>
                        </div>

                        <div class="timeline timeline-second-style clearfix">
                            @foreach ( $education as $e )
                            <div class="timeline-item clearfix">
                                <div class="left-part">
                                    <h5 class="item-period">{{ $e->year }}</h5>
                                    <span class="item-company">{{ $e->school }}</span>
                                </div>
                                <div class="divider"></div>
                                <div class="right-part">
                                    <h4 class="item-title">{{ $e->title }}</h4>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="white-space-50"></div>

                        <div class="block-title">
                            <h3>Experience</h3>
                        </div>

                        <div class="timeline timeline-second-style clearfix">

                            <div class="timeline timeline-second-style clearfix">
                                <div class="timeline timeline-second-style clearfix">
                                    @foreach ( $experience as $ex )
                                    <div class="timeline-item clearfix">
                                        <div class="left-part">
                                            <h5 class="item-period">{{ $ex->year }}</h5>
                                            <span class="item-company">{{ $ex->company }}</span>
                                        </div>
                                        <div class="divider"></div>
                                        <div class="right-part">
                                            <h4 class="item-title">{{ $ex->title }}</h4>
                                        </div>
                                    </div>
                                    @endforeach

                                </div>
                            </div>

                        </div>

                    </div>

                    <!-- Skills & Certificates -->
                    <div class="col-xs-12 col-sm-5">
                        <!-- Design Skills -->
                        <div class="block-title">
                            <h3>Skill<span></span></h3>
                        </div>

                        <div class="skills-info skills-second-style">
                            @foreach ($skill as $s )
                            <div class="skill clearfix">
                                <h4>{{ $s->title }}</h4>
                                <div class="skill-value">{{ $s->percent }} %</div>
                            </div>
                            <div class="skill-container" style="width:{{ $s->percent }}%">
                                <div class="skill-percentage"></div>
                            </div>
                            @endforeach
                        </div>
                        <!-- End of Design Skills -->

                        <div class="white-space-10"></div>

                        <!-- Knowledges -->
                        <div class="block-title">
                            <h3>Knowledges</h3>
                        </div>

                        <ul class="knowledges">
                            @foreach ( $knowledges as $k )
                            <li>{{ $k->title }}</li>
                            @endforeach
                        </ul>
                        <!-- End of Knowledges -->
                    </div>
                    <!-- End of Skills & Certificates -->
                </div>

                <div class="white-space-50"></div>
            </div>
        </section>
        <!-- End of Resume Subpage -->

        <!-- Portfolio Subpage -->
        <section data-id="portfolio" class="animated-section">
            <div class="section-content">
                <div class="page-title">
                    <h2>Portfolio</h2>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12">
                        <!-- Portfolio Content -->
                        <div class="portfolio-content">

                            <ul class="portfolio-filters">
                                <li class="active">
                                    <a class="filter btn btn-sm btn-link" data-group="category_all">All</a>
                                </li>
                                @foreach ($category as $c)
                                <li>
                                    <a class="filter btn btn-sm btn-link" data-group="{{ $c->id }}">{{ $c->title }}</a>
                                </li>
                                @endforeach
                            </ul>

                            <!-- Portfolio Grid -->
                            <div class="portfolio-grid three-columns">

                                @foreach ( $portfolio as $p )
                                <figure class="item standard" data-groups='["category_all", "{{ $p->category_id }}"]'>
                                    <div class="portfolio-item-img">
                                        <img src="{{ asset('upload/portfolio/'.$p->image) }}" height="170px" alt="{{ $p->title }}"
                                            title="{{ $p->title }}" />
                                        <a href="{{ route('detail', $p->slug) }}"></a>
                                    </div>

                                    <i class="far fa-file-alt"></i>
                                    <h4 class="name">{{ $p->title }}</h4>
                                </figure>
                                @endforeach

                            </div>
                        </div>
                        <!-- End of Portfolio Content -->
                    </div>
                </div>
            </div>
        </section>
        <!-- End of Portfolio Subpage -->

        <!-- Blog Subpage -->
        {{-- <section data-id="blog" class="animated-section">
            <div class="section-content">
                <div class="page-title">
                    <h2>Blog</h2>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12">
                        <div class="blog-masonry two-columns clearfix">

                            <!-- Blog Post 1 -->
                            <div class="item post-1">
                                <div class="blog-card">
                                    <div class="media-block">
                                        <div class="category">
                                            <a href="#" title="View all posts in Design">Design</a>
                                        </div>
                                        <a href="blog-post-1.html">
                                            <img src="img/blog/blog_post_1.jpg" class="size-blog-masonry-image-two-c"
                                                alt="Why I Switched to Sketch For UI Design" title="" />
                                            <div class="mask"></div>
                                        </a>
                                    </div>
                                    <div class="post-info">
                                        <div class="post-date">05 Mar 2020</div>
                                        <a href="blog-post-1.html">
                                            <h4 class="blog-item-title">Why I Switched to Sketch For UI Design</h4>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- End of Blog Post 1 -->

                            <!-- Blog Post 2 -->
                            <div class="item post-2">
                                <div class="blog-card">
                                    <div class="media-block">
                                        <div class="category">
                                            <a href="#" title="View all posts in UI">UI</a>
                                        </div>
                                        <a href="blog-post-1.html">
                                            <img src="img/blog/blog_post_2.jpg" class="size-blog-masonry-image-two-c"
                                                alt="Best Practices for Animated Progress Indicators" title="" />
                                            <div class="mask"></div>
                                        </a>
                                    </div>
                                    <div class="post-info">
                                        <div class="post-date">23 Feb 2020</div>
                                        <a href="blog-post-1.html">
                                            <h4 class="blog-item-title">Best Practices for Animated Progress Indicators
                                            </h4>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- End of Blog Post 2 -->

                            <!-- Blog Post 3 -->
                            <div class="item post-1">
                                <div class="blog-card">
                                    <div class="media-block">
                                        <div class="category">
                                            <a href="#" title="View all posts in Design">Design</a>
                                        </div>
                                        <a href="blog-post-1.html">
                                            <img src="img/blog/blog_post_3.jpg" class="size-blog-masonry-image-two-c"
                                                alt="Designing the Perfect Feature Comparison Table" title="" />
                                            <div class="mask"></div>
                                        </a>
                                    </div>
                                    <div class="post-info">
                                        <div class="post-date">06 Feb 2020</div>
                                        <a href="blog-post-1.html">
                                            <h4 class="blog-item-title">Designing the Perfect Feature Comparison Table
                                            </h4>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- End of Blog Post 3 -->

                            <!-- Blog Post 4 -->
                            <div class="item post-2">
                                <div class="blog-card">
                                    <div class="media-block">
                                        <div class="category">
                                            <a href="#" title="View all posts in E-Commerce">UI</a>
                                        </div>
                                        <a href="blog-post-1.html">
                                            <img src="img/blog/blog_post_4.jpg" class="size-blog-masonry-image-two-c"
                                                alt="An Overview of E-Commerce Platforms" title="" />
                                            <div class="mask"></div>
                                        </a>
                                    </div>
                                    <div class="post-info">
                                        <div class="post-date">07 Jan 2020</div>
                                        <a href="blog-post-1.html">
                                            <h4 class="blog-item-title">An Overview of E-Commerce Platforms</h4>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- End of Blog Post 4 -->
                        </div>
                    </div>
                </div>
            </div>


        </section> --}}
        <!-- End of Blog Subpage -->

        <!-- Contact Subpage -->
        <section data-id="contact" class="animated-section">
            <div class="section-content">
                <div class="page-title">
                    <h2>Contact</h2>
                </div>

                <div class="row">
                    <!-- Contact Info -->
                    <div class="col-xs-12 col-sm-4">
                        <div class="lm-info-block gray-default">
                            <i class="lnr lnr-map-marker"></i>
                            <h4>{{ $config->address }}</h4>
                            <span class="lm-info-block-value"></span>
                            <span class="lm-info-block-text"></span>
                        </div>

                        <div class="lm-info-block gray-default">
                            <i class="lnr lnr-phone-handset"></i>
                            <h4>{{ $config->phone }}</h4>
                            <span class="lm-info-block-value"></span>
                            <span class="lm-info-block-text"></span>
                        </div>

                        <div class="lm-info-block gray-default">
                            <i class="lnr lnr-envelope"></i>
                            <h4>{{ $config->email }}</h4>
                            <span class="lm-info-block-value"></span>
                            <span class="lm-info-block-text"></span>
                        </div>

                        <div class="lm-info-block gray-default">
                            <i class="lnr lnr-checkmark-circle"></i>
                            <h4>Freelance Available</h4>
                            <span class="lm-info-block-value"></span>
                            <span class="lm-info-block-text"></span>
                        </div>


                    </div>
                    <!-- End of Contact Info -->

                    <!-- Contact Form -->
                    <div class="col-xs-12 col-sm-8">
                        {{-- <div id="map" class="map"></div> --}}
                        <div class="block-title">
                            <h3>How Can I <span>Help You?</span></h3>
                        </div>

                        <form id="contact_form" class="contact-form" action="{{ route('send.massage') }}" method="post">
                            @csrf

                            <div class="messages"></div>

                            <div class="controls two-columns">
                                <div class="fields clearfix">
                                    <div class="left-column">
                                        <div class="form-group form-group-with-icon">
                                            <input id="form_name" type="text" name="name" class="form-control"
                                                placeholder="" required="required" data-error="Name is required.">
                                            <label>Full Name</label>
                                            <div class="form-control-border"></div>
                                            <div class="help-block with-errors"></div>
                                        </div>

                                        <div class="form-group form-group-with-icon">
                                            <input id="form_email" type="email" name="email" class="form-control"
                                                placeholder="" required="required"
                                                data-error="Valid email is required.">
                                            <label>Email Address</label>
                                            <div class="form-control-border"></div>
                                            <div class="help-block with-errors"></div>
                                        </div>

                                        <div class="form-group form-group-with-icon">
                                            <input id="form_subject" type="text" name="subject" class="form-control"
                                                placeholder="" required="required" data-error="Subject is required.">
                                            <label>Subject</label>
                                            <div class="form-control-border"></div>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="right-column">
                                        <div class="form-group form-group-with-icon">
                                            <textarea id="form_message" name="description" class="form-control"
                                                placeholder="" rows="7" required="required"
                                                data-error="Please, leave me a message."></textarea>
                                            <label>Message</label>
                                            <div class="form-control-border"></div>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="g-recaptcha" data-sitekey="6LdqmCAUAAAAAMMNEZvn6g4W5e0or2sZmAVpxVqI"
                                    data-theme="dark"></div>

                                <input type="submit" class="button btn-send">
                            </div>
                        </form>
                    </div>
                    <!-- End of Contact Form -->
                </div>

            </div>
        </section>
        <!-- End of Contact Subpage -->
    </div>
</div>
@endsection
<link rel="stylesheet" type="text/css" href="{{ asset('admin/plugins/sweetalerts/sweetalert2.min.css') }}">
@push('css')
    
@endpush

@push('js-internal')
<script src="{{ asset('admin/plugins/sweetalerts/sweetalert2.min.js') }}"></script>
<script>
$(function () {

    $('#contact_form').validator();

    $('#contact_form').on('submit', function (e) {
        if (!e.isDefaultPrevented()) {
            var url = "{{ route('send.massage') }}";

            $.ajax({
                type: "POST",
                url: url,
                data: $(this).serialize(),
                success: function (data)
                {

                    $('#contact_form')[0].reset();
                    const toast = swal.mixin({
                        toast: true,
                        position: 'top',
                        showConfirmButton: false,
                        timer: 3000,
                        padding: '2em'
                    });
                    toast({
                        type: 'success',
                        title: 'message sent successfully',
                        padding: '2em',
                    })
                }
            
            });
            return false;
        }
    });
});
</script>
@endpush
