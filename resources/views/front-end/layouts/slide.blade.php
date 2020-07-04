<div id="slider" class="mt-3">
    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <?php $i=0; ?>
            @foreach($slide_h as $s)
                @if($i==0)
                        <div class="carousel-item active">
                            <div class="thumb-cover">
                                <img src="{{asset('/storage/covers/'.$s->image)}}" class="img-fluid" alt="...">
                            </div>

                            <div class="carousel-caption d-none d-md-block">
                                <h3>{{$s->title}}</h3>
                                <p>{{$s->description}}</p>
                            </div>
                        </div>
                    @else
                        <div class="carousel-item">
                            <div class="thumb-cover">
                                <img src="{{asset('/storage/covers/'.$s->image)}}" class="img-fluid" alt="...">
                            </div>

                            <div class="carousel-caption d-none d-md-block">
                                <h3>{{$s->title}}</h3>
                                <p>{{$s->description}}</p>
                            </div>
                        </div>
                    @endif
                    <?php $i++; ?>

            @endforeach

        </div>
        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
