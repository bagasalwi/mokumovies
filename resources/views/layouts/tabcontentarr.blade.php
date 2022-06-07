<div class="col-12 review-text">
    <p class="text-dark text-small fw-500 text-uppercase">{{ $title }}</p>
    <div class="review-box">
        <div class="badges">
            @php
            $genre = $arr;
            $arrGenre = explode (",", $genre);
            @endphp
            @foreach ($arrGenre as $g)
            <a href="#" class="badge badge-dark">{{ $g }}</a>
            @endforeach
        </div>
    </div>
</div>