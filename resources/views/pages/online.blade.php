@extends('layouts.app')


@section('title', $title)


@section('video-fool')


    <h2 class="videoNadpis">Milosť Banská Bystrica</h2>
    štvrtok	|	18:30 hod.	|	Bohoslužby Banská Bystrica </br>
    nedeľa	|	10:30 hod.	|	Bohoslužby Banská Bystrica
        <!-- 16:9 aspect ratio -->
<div class="embed-responsive embed-responsive-16by9">
    <iframe class="embed-responsive-item" src="{{ $milost_bb }}" allowfullscreen ></iframe>
</div>



    <h2 class="videoNadpis">Zbor Baptistov v Aši</h2>
     Začiatok vysielania nedeľa od 9.30 hodiny.
    </br> Začiatok vysielania piatok od 18.00 hodiny.

    <div class="embed-responsive embed-responsive-16by9">
    <iframe class="embed-responsive-item" src="{{ $as_baptisti }}" allowfullscreen></iframe>
</div>


    <h2 class="videoNadpis">Maranata - Spišská nová Ves</h2>
    Začiatok služby je každú nedeľu o 10:00 hodine
<div class="embed-responsive embed-responsive-16by9">
    <iframe class="embed-responsive-item" src="{{ $maranata }}" allowfullscreen></iframe>
</div>

    <h2 class="videoNadpis">Milosť Bratislava</h2>
    Začiatok vysielania nedeľa od 11.00 hodiny.
<div class="embed-responsive embed-responsive-16by9">
    <iframe class="embed-responsive-item" src="{{ $milost_bratislava }}" allowfullscreen></iframe>
</div>

    <h2 class="videoNadpis">Dom viery Poprad</h2>
    Vysielanie prebieha každú nedeľu o 10:30h
<div class="embed-responsive embed-responsive-16by9">
    <iframe class="embed-responsive-item" src="{{ $domViery }}" allowfullscreen></iframe>
</div>





    <h2 class="videoNadpis">Slovo Života Brno</h2>
    <div id="wrapper">

        <div id="iframewrapperslovo">
            <iframe id="target" width="600" height="560" src="http://www.tv7.cz/cirkev-online" scrolling="no" frameborder="0"></iframe>
        </div>
    </div>



    <h2 class="videoNadpis">Zbor Holy Ghost - Česko</h2>
    <iframe style="max-width: 100%;" width="853" height="480" src="//www.youtube.com/embed/" frameborder="0" allowfullscreen=""></iframe>

    </br>Zde můžete sledovat online přenos každou neděli od 11:30.




{{--<h2>Apoštolská cirkev Košice</h2>--}}
{{--<section class="">--}}
{{--<div style="border: 1px solid rgb(201, 0, 1); overflow: hidden; xmargin: 15px auto; max-width: 900px;width: 900px;height: 521px;position: relative;">--}}

{{--<iframe id="target" width="900" height="700" src="http://www.ackosice.sk/onlineHD/"  scrolling="no" frameborder="0"--}}
{{--style="border: 0px none; margin-left: -85px; height: 670px; margin-top: -198px; width: 900px;position: absolute;"></iframe>--}}
{{--</div>--}}
{{--Začiatok vysielania nedeľa 10:30 hod. <br>--}}
{{--Utorok 18.30 hod. mládežnícke stretnutie.--}}
{{--</section>--}}







@endsection