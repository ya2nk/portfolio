@extends('frontend.layout.base')

@section('content')
<div class="content-area single-page-area">
    <div class="single-page-content">

      <article class="post">

        <div class="post-thumbnail">
          <img src="{{ asset('upload/portfolio/'. $portfolio->image) }}" alt="image">
        </div>

        <div class="post-content">
          <!-- /Entry header -->
          <header class="entry-header">
            <!-- Entry meta -->
            <div class="entry-meta entry-meta-top">
              <span><a href="#" rel="category tag">{{ $portfolio->categories->title }}</a></span>        
            </div>
            <!-- /Entry meta -->

            <h2 class="entry-title">{{ $portfolio->title }}</h2>
          </header>
          <!-- /Entry header -->

          <!-- Entry content -->
          <div class="entry-content">
            <div class="row">
              <div class=" col-xs-12 col-sm-12 ">
                <div class="col-inner">
                  {!! $portfolio->description !!}
                </div>
              </div>
            </div>
          </div>
          <!-- /Entry content -->

          <div class="entry-meta entry-meta-bottom">
            <div class="date-author">
              <span class="entry-date">
                <a href="#" rel="bookmark">
                  <i class="far fa-clock"></i> <span class="entry-date"> {{ date('d-m-Y', strtotime($portfolio->created_at)); }}</span>
                </a>
              </span>
              <span class="author vcard">
                <a class="url fn n" href="#" rel="author"> <i class="fas fa-user"></i> yh2bae</a>
              </span>
            </div>

            
          </div>
        </div>
      </article>

    </div>
  </div>
@endsection