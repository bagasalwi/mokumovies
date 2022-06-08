@extends('layouts.master')

@section('content')
<div class="jumbotron jumbotron-fluid bg-transparent mb-0 pb-0">
    <div class="container section mb-0">
        <div class="row">
            <div class="col-12 align-self-center">
                <h1 class="text-white text-center font-weight-bold" data-font-size="38px">Mokumovies!</h1>
                <p class="mb-3 text-white text-center" data-font-size="18px">
                    {{__('lang.home.welcome')}}
                </p>
            </div>
        </div>
    </div>
</div>

<div class="section mt-2">
    <div class="container">
        <div class="card card-body border-0 bd-radius-2 shadow-sm mb-4">
            <div class="row">
                <div class="col-md-8 col-12 mb-2">
                    <h6 class="text-dark no-pm">{{__('lang.home.searchLabel')}} :</h6>
                    <input type="text" id="searchmovie" name="s" class="inputSearch" placeholder="{{__('lang.home.searchPlaceholder')}}"
                        value="{{ isset($search_meta ) ? $search_meta : ""  }}">
                </div>
                <div class="col-6 col-md-2 mb-2">
                    <h6 class="text-dark no-pm">{{__('lang.home.type')}} :</h6>
                    <select class="form-control mt-2" name="type" id="type">
                        <option value="all">all</option>
                        <option value="movie">movie</option>
                        <option value="series">series</option>
                        <option value="episode">episode</option>
                    </select>
                </div>
                <div class="col-6 col-md-2 mb-2">
                    <h6 class="text-dark no-pm">{{__('lang.home.year')}} :</h6>
                    <select class="form-control mt-2" name="type" id="year">
                        <option value="all">all</option>
                        <option value="2022">2022</option>
                        <option value="2021">2021</option>
                        <option value="2020">2020</option>
                    </select>
                </div>
            </div>
        </div>

        <div id="datahasil" class="row" data-page="" data-search="" data-type="" data-year="" data-no-more="">
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
                var type = $("#datahasil").data('type');
                var year = $("#datahasil").data('year');
                var nomore = $("#datahasil").data('no-more');
                
                if(nomore == 'true'){
                    alert('no more');
                    return false;
                }else{
                    getData(page, search, type, year);
                }
            }
        });

        function getData(page, search, type, year) {
            $('#preloader').html('<img class="col-12 text-center" src="{{ asset('preloader.gif') }}" alt="">');
            $.ajax({
                url:"movie/search",
                type:"GET",
                data: {
                    's' : search,
                    'page' : page+1,
                    'type' : type,
                    'y' : year,
                },
                success:function(data){
                    if(data.success == 'false'){
                        $('#datahasil').append(data.html);
                        $("#datahasil").data('no-more', 'true');
                    }else{
                        $('#datahasil').append(data);
                        $("#datahasil").data('page', page+1);
                        $('#preloader').html('');
                    }
                },
                error:function(data){
                    $('#preloader').html('<h6>No More Data</h6>');
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
        
        $('#searchmovie,#type,#year').on('keyup change', function() {
            clearTimeout($('#searchmovie').data('timer'));
            var search = $('#searchmovie').val();
            var type = $('#type').find(":selected").text();
            var year = $('#year').find(":selected").text();

            
            console.log(search+ '-' +type+ '-' +year);
            if (search.length >= 3) {
                $('#datahasil').html('<img class="col-12 text-center" src="{{ asset('preloader.gif') }}" alt="">');
                $('#searchmovie').data('timer', setTimeout(function() {
                    $.ajax({
                        delay: 500,
                        type: "GET",
                        url: "movie/search",
                        data: {
                            's' : search,
                            'type' : type,
                            'y' : year,
                            // 'page' : 1
                        },
                        dataType: "text",
                        success: function(data){
                            $("#datahasil").html(data);
                            $("#datahasil").data('page', 1);
                            $("#datahasil").data('search', search);
                            $("#datahasil").data('type', type);
                            $("#datahasil").data('year', year);
                        },
                        error: function(data){
                            $("#datahasil").html("<h6>No More Data</h6>");
                        }});
                }, 500));
            }else{
                $('#datahasil').html('');
            }
        });
    </script>
@endpush
