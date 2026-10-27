@extends('template.base')
<!-- directiva de blade, para indicar que se hereda de un documento -->

@section('content')
<div class="container d-flex align-items-center flex-column">
    <h1>Listado de alumnos</h1>
    <h2>{{ $grupo }} {{ $profesor }}</h2>
</div>
@endsection

@section('portfolio')
<!-- Portfolio Section-->
        <section class="page-section portfolio" id="portfolio">
            <div class="container">
                <!-- Portfolio Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Portfolio</h2>
                <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- Portfolio Grid Items-->
                <div class="row justify-content-center">
                    @foreach($alumnos as $alumno)
                         <div class="col-md-6 col-lg-4 mb-5">
                        <div class="portfolio-item mx-auto" data-bs-toggle="modal" data-bs-target="#portfolioModal1">
                            @if($alumno['edad'] < 20)
                                <img class="img-fluid" src="{{ asset ('assets/img/portfolio/cabin.png')}}" alt="..." />
                            @else
                            <img class="img-fluid" src="{{ asset ('assets/img/portfolio/safe.png')}}" alt="..." />
                            @endif
                            
                            <br>{{ $alumno['nombre'] }}
                        </div>
                    </div>
                    @endforeach
                   
                </div>
            </div>
        </section>
@endsection