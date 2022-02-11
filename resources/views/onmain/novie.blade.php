@extends('layouts.layout')

{{--@section('title', 'Новые Новостройки')--}}
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
                @foreach($novie as $rec)
                    @include('chunk.jk', ['rec' => $rec])
                @endforeach

                <div class="clear"></div>
            </div>
        </div>
        <div class="pagination-block">
            {{ $novie->links('chunk.pagination') }}
        </div>
    </section>



@endsection