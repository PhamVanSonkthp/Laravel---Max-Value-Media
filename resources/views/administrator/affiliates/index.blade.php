@extends('administrator.layouts.master')

@include('administrator.'.$prefixView.'.header')

@section('css')
    <link rel="stylesheet" href="https://unpkg.com/treeflex/dist/css/treeflex.css">
@endsection

@section('content')

    <div class="container-fluid list-products">
        <div class="row">
            <div class="col-12">

                <div id="tree" style="font-size: 60px;">
                    @foreach($items as $item)
                        {!! $item->renderChildrenTreeView($item->id, "", false, false, true) !!}
                    @endforeach
                </div>



            </div>

        </div>
    </div>

@endsection

@section('js')
    <script>

        let now_scale = 1;
        let font_size = 16;
        function zoom(event) {
            event.preventDefault();

            scale += event.deltaY * -0.001;

            if(now_scale < scale){
                font_size+=2
            }else{
                font_size-=2
            }

            now_scale = scale;

            $('.tf-tree').css('font-size', font_size + 'px')

            // // Restrict scale
            // scale = Math.min(Math.max(0.125, scale), 4);
            //
            // // Apply scale transform
            // el.style.transform = `scale(${scale})`;
        }

        let scale = 1;
        const el = document.getElementById("tree");
        el.onwheel = zoom;

    </script>
@endsection

