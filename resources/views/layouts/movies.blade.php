@foreach ($body->Search as $item)
<div class="col-6 col-lg-3 col-md-6 col-sm-6 my-2">
    <a href="{{ url('movie/'.$item->imdbID.'/'. strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $item->Title)))) }}"
        class="card-block clearfix">
        <div class="card border-0 bd-radius-4 shadow">
            <div class="card-img-wrap">
                <img class="card-img-top img-fluid img-imagemovies" loading="lazy"
                src="{{ $item->Poster }}" alt="">
                <div class="card-img-overlay">
                    <div class="badge badge-white align-self-center bd-radius-2">
                        <span class="font-weight-bold no-pm">{{ $item->Year }}</span>
                    </div>
                </div>
            </div>
        </div>
    </a>
    <div class="fw-600 text-center text-white">
        <h6 class="pt-2">{{ $item->Title }}</h6>
        <button onclick="addFavorite('{{ $item->Title }}','{{ $item->imdbID }}','{{ $item->Poster }}','{{ $item->Year }}')" class="btn btn-light btn-sm">tambah favorit</button>
    </div>
</div>
@endforeach