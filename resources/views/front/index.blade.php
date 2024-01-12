    @extends('layouts.front')
    @section('content')
    <section class="s-content s-content--no-top-padding">
        <div class="s-bricks">
            <div class="masonry">
                <div class="bricks-wrapper h-group">
                    <div class="grid-sizer"></div>
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    @foreach ($posts as $post)
                    <article class="brick entry" data-aos="fade-up">
                        <div class="entry__text">
                            <div class="entry__header">
                                <h1 class="entry__title"><a href="{{ route('posts.view', $post->id) }}">{{ $post->title }}</a></h1>
                                <div class="entry__meta">
                                    <span class="byline">By:
                                        <span class='author'>
                                            <a href="#">{{ $post->user->name }}</a>
                                        </span>
                                    </span>
                                    <span class="cat-links">
                                        <a href="#">{{ optional($post->categories->first())->title }}</a>
                                    </span>
                                </div>
                            </div>
                            <div class="entry__excerpt">
                                <p>{{ $post->excerpt }}</p>
                            </div>
                            <a class="entry__more-link" href="{{ route('posts.view', $post->id) }}">Learn More</a>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endsection