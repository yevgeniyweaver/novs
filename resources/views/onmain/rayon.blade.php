@extends('layouts.layout')

@section('title', 'Все Новостройки')
{{--@section('sidebar')--}}
{{--@parent--}}
{{--<p>Это дополнение к основной боковой панели.</p>--}}
{{--@endsection--}}

@section('content')

    <section class="popular-complex">
        <div class="popular-block">
            <div class="popular-title">
                Новые новостройки в Одессе
            </div>
            <div class="jk-box">
                {{--@each('chunk.jk', $objects, 'req')--}}
                @foreach($rayons_obj as $rec)
                    @include('chunk.jk', ['rec' => $rec])
                @endforeach

                <div class="clear"></div>
            </div>
        </div>
        <div class="pagination-block">
            {{ $rayons_obj->links('chunk.pagination') }}
        </div>
    </section>



@endsection