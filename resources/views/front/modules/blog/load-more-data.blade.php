@forelse ($results as $bloge)          
   <div class="col-md-4">
      <div class="blog-inner">
         <figure><img src="{{ asset('uploads/banners/'.$bloge->media) }}"></figure>
         <div class="blog-contain">
            <a href="{{ route('blog.detail',$bloge->blog_slug) }}">
               <h3>{{ $bloge->title }}
               </h3>
            </a>
            <div class="blog-label"><span class="time"><i class="fa-regular fa-clock"></i><span>{{ $bloge->created_at->format('d M Y') }}</span></span>
            </div>
            <p>{!!  \Illuminate\Support\Str::words($bloge->short_description, 30, '...') !!}
            </p>
            
            <a class="blog-button" href="{{ route('blog.detail',$bloge->blog_slug) }}">
            Read
            More <i class="fa-solid fa-arrow-up"></i></a>
         </div>
      </div>
   </div>
@empty
   <div class="col-12 text-center py-5">
      <i class="fa-solid fa-box-open" style="font-size: 48px; color: #ccc;"></i>
      <p class="mt-3 fs-5">No products found</p>
   </div>
@endforelse