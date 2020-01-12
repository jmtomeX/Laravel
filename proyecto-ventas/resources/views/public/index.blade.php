@extends('layouts.home_public')

@section('content')
<!-- banner-Slider -->
<div class="slider">
    <div class="callbacks_container">
        <ul class="rslides callbacks callbacks1" id="slider4">
            <li>
                <div class="w3layouts-banner-top">
                    <div class="banner-dott">
                        <div class="container">
                            <div class="padding">
                                <div class="agileits-banner-info">
                                    <p>We Provide</p>
                                    <h2 class="second">Quality photography services </h2>
                                </div>
                                <ul class="social text-center mt-sm-5 mt-3">
                                    <li><a class="" href="#"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
                                    </li>
                                    <li><a class="" href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a class="" href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                    <li><a class="" href="#"><i class="fab fa-google-plus"></i></a></li>
                                    <li><a class="" href="#"><i class="fab fa-instagram" aria-hidden="true"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <div class="w3layouts-banner-top w3layouts-banner-top1">
                    <div class="banner-dott">
                        <div class="container">
                            <div class="padding">
                                <div class="agileits-banner-info">
                                    <p>We Provide</p>
                                    <h3 class="second">The Best Location for Photoshoot</h3>
                                </div>
                                <ul class="social text-center mt-sm-5 mt-3">
                                    <li><a class="" href="#"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
                                    </li>
                                    <li><a class="" href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a class="" href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                    <li><a class="" href="#"><i class="fab fa-google-plus"></i></a></li>
                                    <li><a class="" href="#"><i class="fab fa-instagram" aria-hidden="true"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <div class="w3layouts-banner-top w3layouts-banner-top2">
                    <div class="banner-dott">
                        <div class="container">
                            <div class="padding">
                                <div class="agileits-banner-info">
                                    <p>We Provide</p>
                                    <h3 class="second">Quality Photography Product </h3>
                                </div>
                                <ul class="social text-center mt-sm-5 mt-3">
                                    <li><a class="" href="#"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
                                    </li>
                                    <li><a class="" href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a class="" href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                    <li><a class="" href="#"><i class="fab fa-google-plus"></i></a></li>
                                    <li><a class="" href="#"><i class="fab fa-instagram" aria-hidden="true"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <div class="w3layouts-banner-top w3layouts-banner-top3">
                    <div class="banner-dott">
                        <div class="container">
                            <div class="padding">
                                <div class="agileits-banner-info">
                                    <p>We Provide</p>
                                    <h3 class="second">Creative Photography stills </h3>
                                </div>
                                <ul class="social text-center mt-sm-5 mt-3">
                                    <li><a class="" href="#"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
                                    </li>
                                    <li><a class="" href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a class="" href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                    <li><a class="" href="#"><i class="fab fa-google-plus"></i></a></li>
                                    <li><a class="" href="#"><i class="fab fa-instagram" aria-hidden="true"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    <div class="clearfix"> </div>
</div>
<!-- banner-Slider -->
</div>
<!-- //banner -->

<!-- about -->
<section class="about py-5">
    <div class="container py-3">
        <div class="row bottom-grids">
            <div class="col-lg-8 bottom-grid1">
                <!-- Listado de productos -->
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">PRODUCTO</th>
                            <th scope="col">DESCRIPCION</th>
                            <th scope="col">OPINIONES</th>
                            <th scope="col">VALORACIÓN</th>
                            <th scope="col">IMAGEN</th>
                            <th scope="col">PRECIO</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($prs as $pr)
                        @php ($img_url='')
                        @isset($pr->image)
                        @php ($img_url=$pr->image)
                        @if (strpos($pr->image, 'http') === false)
                        @php ($img_url=asset('img_uploads')."/".$pr->image)
                        @endif
                        @endisset
                        @php ($opinion_count = $pr->opinions()->count())
                        @php ($opinion_avg = $pr->opinions()->avg('valor'))
                        @php ($opiniones="")
                        @foreach ($pr->opinions()->get() as $opinion)
                        @php ($opiniones.=$opinion->titulo)
                        @endforeach
                        <tr>
                            @php ($pr_id = $pr->id)
                            <th scope="row" title="{{$opiniones}}">{{$pr_id}}</th>
                            <td>{{$pr->producto}}</td>
                            @php ($txt = $pr->descripcion)
                            @php($str = (substr($txt, 0, 100)))
                            <td>{{$str.'...'}}</td>

                            @if ($opinion_count == 0)
                            <td>{{$opinion_count}}</td>
                            @else
                            <td><a href="{{url('productos/opiniones')}}/{{$pr_id}}">{{$opinion_count}}</a></td>
                            @endif
                            <td>{{number_format($opinion_avg,0)}}</td>
                            <td>{{$img_url}}</td>
                            <td><img src="{{$img_url}}" alt="" width="250"></td>
                            <td>{{$pr->precio}}</td>
                            <td><button  data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo" onclick="opinionProductNum({{$pr_id}})">Añadir Opinion</button></td>
                           
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Mostrar navegación -->
                {{ $prs->links() }}
				<!-- Modal -->      
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <form method="post" action="{{url('productos/public/setOpinion')}}">
                    @csrf
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Nuevo comentario</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                
                                    <div class="form-group">
                                        <label for="titulo" class="col-form-label">Titulo</label>
                                        <input type="text" class="form-control" id="titulo" name="titulo">
                                    </div>
                                    <div class="form-group">
                                        <label for="message-text" class="col-form-label">Comentario</label>
                                        <textarea class="form-control" id="messagetext" name="messagetext"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="valor" class="col-form-label">Puntuación</label>
                                        <input type="number" min="0" max= "5" class="form-control" id="valor" name="valor"></input>
                                        <input type="text"  id="id_prod" name="id_prod" value="" hidden></input>
                                    </div>
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Enviar opinion</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                <!-- Fin Listado de productos -->
            </div>

        </div>
    </div>
</section>
<!-- //about -->

<!-- services -->
<section class="services">
    <div class="banner-dott1 py-5">
        <div class="container py-3">
            <h3 class="heading text-center mb-5 pb-lg-5">Why Choose Us</h3>
            <div class="row servicegrids">
                <div class="col-lg-3 col-sm-6">
                    <div class="grid1">
                        <i class="fas fa-money-bill-alt mr-3"></i>
                        <h3>Reasonable <span>prices</span></h3>
                        <p class=""> Phasellus iaculis sapien. </p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 mt-sm-0 mt-5">
                    <div class="grid1">
                        <i class="fa fa-trophy mr-3" aria-hidden="true"></i>
                        <h3>Creative <span>Works</span></h3>
                        <p class=""> Phasellus iaculis sapien. </p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 mt-lg-0 mt-5">
                    <div class="grid1">
                        <i class="fas fa-images mr-3"></i>
                        <h3>Album <span>Works</span></h3>
                        <p class=""> Phasellus iaculis sapien. </p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 mt-lg-0 mt-5">
                    <div class="grid1">
                        <i class="fa fa-camera mr-3" aria-hidden="true"></i>
                        <h3>No <span>Photoshop</span></h3>
                        <p class=""> Phasellus iaculis sapien. </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- //services -->

<!-- how we work -->
<section class="work py-5">
    <div class="container py-lg-5 p-sm-3">
        <div class="row">
            <div class="col-lg-5 bannerbottomright">
                <h3>We work for</h3>
                <p class="my-4"> Phasellus iaculis sapien in tellus gravida, lorem placerat in lacus elementum. Nulla
                    vitae lacus nec elit mollis pretium. Sed sed nunc lectus. lorem placerat in lacus elementum. </p>
                <h4><i class="fa clr1 fa-trophy mr-3" aria-hidden="true"></i>Award winning photography</h4>
                <h4><i class="fas clr2 fa-camera-retro mr-3"></i>Fashion Photography</h4>
                <h4><i class="fa clr3 fa-video mr-3" aria-hidden="true"></i>Wedding and Events Photography</h4>
                <h4><i class="fa clr4 fa-space-shuttle mr-3" aria-hidden="true"></i>Nature and Wild Photography</h4>
                <h4><i class="fas clr5 fa-film mr-3"></i>Cinematic photography</h4>
            </div>
            <div class="col-lg-7 serv-img mt-lg-0 mt-5 ">
                <img src="public_template/images/ser1.jpg" alt="" class="img-fluid" />
                <img src="public_template/images/ser2.jpg" alt="" class="img-fluid" />
                <img src="public_template/images/ser3.jpg" alt="" class="img-fluid" />
                <img src="public_template/images/ser4.jpg" alt="" class="img-fluid" />
                <img src="public_template/images/ser5.jpg" alt="" class="img-fluid" />
                <img src="public_template/images/ser6.jpg" alt="" class="img-fluid" />
                <img src="public_template/images/ser7.jpg" alt="" class="img-fluid" />
                <img src="public_template/images/ser8.jpg" alt="" class="img-fluid" />
                <img src="public_template/images/ser9.jpg" alt="" class="img-fluid" />
                <img src="public_template/images/ser0.jpg" alt="" class="img-fluid" />
                <div class="clearfix"></div>
                <p class="my-4 text-center"> Phasellus iaculis sapien in tellus gravida, lorem placerat in lacus
                    elementum. Nulla vitae lacus nec elit mollis pretium. Sed sed nunc lectus. </p>
                <div class="explore text-center mt-4">
                    <a href="#">Explore All Shots</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- //how we work -->

<!-- middle slider -->
<div class="projects" id="special">
    <div class="projects-grids">
        <div class="sreen-gallery-cursual">
            <ul id="flexiselDemo1">
                <li>
                    <div class="item">
                        <div class="projects-agile-grid-info">
                            <img src="public_template/images/ser1.jpg" alt="" />
                            <div class="projects-grid-caption">
                                <i class="fab mr-2 fa-tripadvisor"></i>
                                <h4>Photo Bum</h4>
                                <p>Photography stills</p>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="item">
                        <div class="projects-agile-grid-info">
                            <img src="public_template/images/ser2.jpg" alt="" />
                            <div class="projects-grid-caption">
                                <i class="fab mr-2 fa-tripadvisor"></i>
                                <h4>Photo Bum</h4>
                                <p>Photography stills</p>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="item">
                        <div class="projects-agile-grid-info">
                            <img src="public_template/images/ser3.jpg" alt="" />
                            <div class="projects-grid-caption">
                                <i class="fab mr-2 fa-tripadvisor"></i>
                                <h4>Photo Bum</h4>
                                <p>Photography stills</p>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="item">
                        <div class="projects-agile-grid-info">
                            <img src="public_template/images/ser4.jpg" alt="" />
                            <div class="projects-grid-caption">
                                <i class="fab mr-2 fa-tripadvisor"></i>
                                <h4>Photo Bum</h4>
                                <p>Photography stills</p>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="item">
                        <div class="projects-agile-grid-info">
                            <img src="public_template/images/ser3.jpg" alt="" />
                            <div class="projects-grid-caption">
                                <i class="fab mr-2 fa-tripadvisor"></i>
                                <h4>Photo Bum</h4>
                                <p>Photography stills</p>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- //middle slider -->

<!-- distance -->
<section class="distance-w3 py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 distance-agile-left">
                <h4 class="mt-2">Want to make your photography more unique?</h4>
            </div>
            <div class="col-lg-4 distance-agile-right mt-lg-0 mt-4">
                <a href="contact.html">Call Us : +1-244-368-9527</a>
            </div>
        </div>
    </div>
</section>
<!-- //distance -->

<!-- stats -->
<section class="stats py-5">
    <div class="container py-3">
        <h3 class="heading text-center mb-5">Our Stats</h3>
        <div class="row inner_w3l_agile_grids-1">
            <div class="col-lg-3 col-6 w3layouts_stats_left w3_counter_grid">
                <p class="counter">2000</p>
                <h3>Captured Photos</h3>
                <h6><i class="fab mr-2 fa-tripadvisor"></i>Photo Bum</h6>
            </div>
            <div class="col-lg-3 col-6 w3layouts_stats_left w3_counter_grid1">
                <p class="counter">1250</p>
                <h3>Photo Albums</h3>
                <h6><i class="fab mr-2 fa-tripadvisor"></i>Photo Bum</h6>
            </div>
            <div class="col-lg-3 col-6 mt-lg-0 mt-4 w3layouts_stats_left w3_counter_grid2">
                <p class="counter">1563</p>
                <h3>Happy Customers</h3>
                <h6><i class="fab mr-2 fa-tripadvisor"></i>Photo Bum</h6>
            </div>
            <div class="col-lg-3 col-6 mt-lg-0 mt-4 w3layouts_stats_left w3_counter_grid2">
                <p class="counter">250</p>
                <h3>Awards </h3>
                <h6><i class="fab mr-2 fa-tripadvisor"></i>Photo Bum</h6>
            </div>
        </div>
    </div>
</section>
<script>
function opinionProductNum(id) {
    console.log(id)
    $("#id_prod").val(id);
}
</script>
<!-- //stats -->
@endsection