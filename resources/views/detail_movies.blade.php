@extends('layouts.master')

@section('content')
{{-- {{ dd($body) }} --}}
<div class="jumbotron jumbotron-fluid bg-transparent mb-0"
    style="padding-bottom: 80px; margin-bottom: -200px !important;">
    <div class="container section">
        <div class="row">
            <div class="col-12 align-self-center">
                <h1 class="text-white fw-700 no-pm data-font-size="40px"">{{ $body->Title }}</h1>
                <h6 class="no-pm ">
                    <span class="badge badge-white font-weight-bold">{{ $body->Rated }}</span>
                    <span class="badge badge-white font-weight-bold">Released : {{ $body->Released }}</span>
                </h6>
                
            </div>
        </div>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-12">
                <div class="card-img-wrap mb-3" data-toggle="tooltip" data-placement="top"
                    title="#">
                    <img class="img-review bd-radius-2 mx-auto d-block shadow-sm" loading="lazy"
                        src="{{ $body->Poster }}" alt="">
                </div>
                <a href="{{ $body->Website }}" class="btn btn-sm btn-light btn-block mb-4">Visit Website</a>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="card card-body bd-radius-2">
                    <div class="row no-pm">
                        <div class="col-md-12 col-12 no-pm">
                            <ul class="nav nav-tabs" id="detail-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="information-tab" data-toggle="tab"
                                        href="#information" role="tab" aria-controls="home"
                                        aria-selected="true">Information</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="synopsis-tab" data-toggle="tab"
                                        href="#synopsis" role="tab" aria-controls="synopsis"
                                        aria-selected="false">Plot</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="directions-tab" data-toggle="tab"
                                        href="#directions" role="tab" aria-controls="directions"
                                        aria-selected="false">Directions Information</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="ratings-tab" data-toggle="tab"
                                        href="#ratings" role="tab" aria-controls="ratings"
                                        aria-selected="false">Ratings</a>
                                </li>
                            </ul>
                            <div class="tab-content mx-3">
                                <div class="tab-pane fade show active review-info" id="information" role="tabpanel"
                                    aria-labelledby="review-info">
                                    <div class="row">
                                        @include('layouts.tabcontent',['title' => 'Type', 'desc' => $body->Type])
                                        @include('layouts.tabcontent',['title' => 'Runtime', 'desc' => $body->Runtime])
                                        
                                        @include('layouts.tabcontentarr',['title' => 'Genre', 'arr' => $body->Genre])
                                        @include('layouts.tabcontentarr',['title' => 'Language', 'arr' => $body->Language])
                                        @include('layouts.tabcontentarr',['title' => 'Country', 'arr' => $body->Country])
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="synopsis" role="tabpanel" aria-labelledby="synopsis">
                                    <div class="text-synopsis">{{ $body->Plot }}</div>
                                </div>
                                <div class="tab-pane fade" id="ratings" role="tabpanel" aria-labelledby="ratings">
                                    <div class="row">
                                        @foreach ($body->Ratings as $r)
                                            @include('layouts.tabcontent',['title' => $r->Source, 'desc' => $r->Value])
                                        @endforeach

                                        @include('layouts.tabcontent',['title' => 'Metascore', 'desc' => $body->Metascore])
                                        @include('layouts.tabcontent',['title' => 'IMDB Total Votes', 'desc' => $body->imdbVotes])
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="directions" role="tabpanel" aria-labelledby="directions">
                                    <div class="row">
                                        @include('layouts.tabcontent',['title' => 'Director', 'desc' => $body->Director])
                                        @include('layouts.tabcontent',['title' => 'Writer', 'desc' => $body->Writer])
                                        @include('layouts.tabcontentarr',['title' => 'Actors', 'arr' => $body->Actors])
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection