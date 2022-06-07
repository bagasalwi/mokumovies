@extends('layouts.master')

@section('content')
<div class="jumbotron jumbotron-fluid bg-transparent mb-0 pb-0">
    <div class="container section mb-0">
        <div class="row">
            <div class="col-12 align-self-center">
                <h1 class="text-white text-center font-weight-bold" data-font-size="38px">My Favorite Movies</h1>
                <p class="mb-3 text-white text-center" data-font-size="18px">
                    
                </p>
            </div>
        </div>
    </div>
</div>

<div class="section mt-2">
    <div class="container">
        {{-- <div class="card card-body border-0 bd-radius-2 shadow-sm mb-4">
            <h6 class="text-dark no-pm">Search any movies :</h6>
            <form action="{{ route('search') }}" role="search">
                <input type="text" id="searchmovie" name="s" class="inputSearch" placeholder="Search.."
                    value="{{ isset($search_meta ) ? $search_meta : ""  }}">
            </form>
        </div> --}}

        <div id="favorite" class="row" data-page="" data-search="">
            @foreach ($favorites as $item)
            <div class="col-6 col-lg-3 col-md-6 col-sm-6 my-2">
                <a href="{{ url('movie/'.$item->imdbid.'/'. strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $item->title)))) }}"
                    class="card-block clearfix">
                    <div class="card border-0 bd-radius-4 shadow">
                        <div class="card-img-wrap">
                            <img class="card-img-top img-fluid img-imagemovies" loading="lazy"
                            src="{{ $item->poster_url }}" alt="">
                            <div class="card-img-overlay">
                                <div class="badge badge-white align-self-center bd-radius-2">
                                    <span class="font-weight-bold no-pm">{{ $item->year }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <div class="fw-600 text-center text-white">
                    <h6 class="pt-2">{{ $item->title }}</h6>
                    {{-- <button onclick="addFavorite('{{ $item->title }}','{{ $item->imdbID }}','{{ $item->poster_url }}','{{ $item->year }}')" class="btn btn-light btn-sm">tambah favorit</button> --}}
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection