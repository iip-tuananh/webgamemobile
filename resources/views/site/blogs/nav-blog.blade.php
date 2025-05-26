<div class="widget-right-section mb-30">
    <div class="widget widget__post mb-50">
        <div class="widget-title-box mb-20">
            <h4 class="widget__title__three">Bài viết liên quan</h4>
        </div>
        <ul class="post-list">
            @foreach ($other_blogs as $item)
            <li>
                <div class="recent__post mb-20">
                    <a class="post__thumb" href="{{ route('front.detail-blog', $item->slug) }}">
                        <img style="width: 100px; height: 100px;" src="{{ $item->image ? $item->image->path : '' }}" alt="Post Img" loading="lazy">
                    </a>
                    <div class="post__content">
                        <span>{{ $item->category->name }}</span>
                        <h5 class="mb-10"><a href="{{ route('front.detail-blog', $item->slug) }}">{{ $item->name }}</a>
                        </h5>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
    <div class="widget widget-categories-list">
        <div class="widget-title-box mb-20">
            <h4 class="widget__title__three">Danh mục dịch vụ</h4>
        </div>
        <ul class="list-none service-widget">
            @foreach ($productCategories as $item)
            <li><a href="{{ route('front.show-product-category', $item->slug) }}">{{ $item->name }} <span class="float-end">{{ $item->products->count() }}</span></a></li>
            @endforeach
        </ul>
    </div>
</div>