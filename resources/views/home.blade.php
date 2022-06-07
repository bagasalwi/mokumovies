@extends('layouts.master')

@section('content')
<div class="jumbotron jumbotron-fluid bg-transparent mb-0 pb-0">
    <div class="container section mb-0">
        <div class="row">
            <div class="col-12 align-self-center">
                <h1 class="text-white text-center font-weight-bold" data-font-size="38px">Mokumovies!</h1>
                <p class="mb-3 text-white text-center" data-font-size="18px">
                    {{__('lang.welcome')}}
                </p>
            </div>
        </div>
    </div>
</div>

<div class="section mt-2">
    <div class="container">
        <div class="card card-body border-0 bd-radius-2 shadow-sm mb-4">
            <h6 class="text-dark no-pm">Search any movies :</h6>
            <input type="text" id="searchmovie" name="s" class="inputSearch" placeholder="Search.."
                value="{{ isset($search_meta ) ? $search_meta : ""  }}">
        </div>

        <div id="datahasil" class="row" data-page="" data-search="">
        </div>
        <div id="preloader" class="col-12 p-4">
        </div>
    </div>
</div>
@endsection

@push('script')
    <script>
        $(window).scroll(function () {
            if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
                var search = $("#datahasil").data('search');
                var page = $("#datahasil").data('page');
                getData(page, search);
            }
        });

        function getData(page, search) {
            $('#preloader').html('<img class="col-12 text-center" src="{{ asset('preloader.gif') }}" alt="">');
            $.ajax({
                url:"movie/search",
                type:"GET",
                data: {
                    's' : search,
                    'page' : page+1
                },
                success:function(data){
                    $('#datahasil').append(data);
                    $("#datahasil").data('page', page+1);
                    $("#datahasil").data('search', search);
                    $('#preloader').html('');
                }
            })
        }

        function addFavorite(title, imdbid, poster_url, year) {
            // alert(title);
            $.ajax({
                url:"movie/addfavorites",
                type:"GET",
                data: {
                    'title' : title,
                    'imdbid' : imdbid,
                    'poster_url' : poster_url,
                    'year' : year,
                },
                success:function(data){
                    if(data.success == true){
                        swal("Success!",data.message,"success");
                    }else{
                        swal("Error!",data.message,"error");
                    }
                },
                error:function(data){
                    swal("Error!","Failed to add to Favorites","error");
                }
            })
        }
        
        $('#searchmovie').on('keyup', function() {
            clearTimeout($(this).data('timer'));
            var search = $(this).val();
            // alert(search);
            if (search.length >= 3) {
                $('#datahasil').html('<img class="col-12 text-center" src="{{ asset('preloader.gif') }}" alt="">');
                $(this).data('timer', setTimeout(function() {
                    $.ajax({
                        delay: 500,
                        type: "GET",
                        url: "movie/search",
                        data: {
                            's' : search,
                            // 'page' : 1
                        },
                        dataType: "text",
                        success: function(data){
                            $("#datahasil").html(data);
                            $("#datahasil").data('page', 1);
                            $("#datahasil").data('search', search);
                        }});
                }, 500));
            }else{
                $('#datahasil').html('');
            }
        });
    </script>
@endpush
