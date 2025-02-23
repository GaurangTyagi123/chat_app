@extends('layouts.app')

@section('content')
<div class="home__container">
    <div class="chat__list__container" id="chat_list" data-hidden="true"></div>
    <div class="chat__container" id="chat_container"></div>
@endsection
@section("scripts")
    <script>
        const data = {
            user_id : {!! auth()->user()->id !!},
            users : {!! $users !!},
            chat : {!! $chat ?? 0 !!},
        }
        const url = `{{ config('app.url','127.0.1.3') }}`
        const navbar__arrow = document.querySelector(".navbar__arrow");
        navbar__arrow.addEventListener("click",e=>{
            const chat__list__container = document.querySelector(".chat__list__container");
            if(chat__list__container){
                let chat__container__flag = chat__list__container.getAttribute("data-hidden");
                chat__container__flag === "false" ?  chat__list__container.setAttribute("data-hidden","true") : chat__list__container.setAttribute("data-hidden","false")
            }
        })
    </script>
@endsection
