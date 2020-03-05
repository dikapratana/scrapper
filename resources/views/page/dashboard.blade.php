@extends('layouts.base_template')

@section('title', 'Home')

@section('content-header')
<h1>Produk</h1>

@endsection

@section('content')
<select id="product_sort_option" class="form-control" include_blank="false" label="false" data-ga-event-data="{&quot;category&quot;:&quot;search_sort&quot;,&quot;action&quot;:&quot;search_sort&quot;}" class="select optional c-inp qa-search-sort-option-dropdown" name="search[sort_by]"><option value="_score:desc">Relevansi</option>
    <option value="last_relist_at:desc">Terbaru</option>
    <option value="price:asc">Termurah</option>
    <option value="price:desc">Termahal</option>
    <option selected="selected" value="weekly_sales_ratio:desc">Terlaris</option>
    <option value="view_count:desc">Terbanyak dilihat</option>
    <option value="favorite_count:desc">Favorit paling banyak</option>
    <option value="rating_ratio:desc">Rating tertinggi</option>
</select>
<div class="row" id="list-product">

</div>


@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('body').on('click','#search-btn',function(e){
                e.preventDefault();
                var keyword = $('#keyword').val();
                var filter = $('#product_sort_option').val();
                var token = $('input[name="_token"]').val()

                ajax(keyword, filter,token)
            })
            $('body').on('change','#product_sort_option',function(e){
                e.preventDefault();
                var keyword = $('#keyword').val();
                var filter = $('#product_sort_option').val();
                var token = $('input[name="_token"]').val()

                ajax(keyword, filter,token)
            })

        })
     function ajax(keyword, filter,token){
        console.log(keyword);
            $.ajax({
                    url      : '{{route('home.crawling')}}',
                    data     : {keyword : keyword, filter : filter, _token : token},
                    dataType : 'json',
                    method   : 'post'
                }).done(function(res){
                    console.log(res);
                    $('#list-product').html(res.html)
                }).fail().always(function(){

                });
        }
    </script>
@endsection
