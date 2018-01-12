<div style="width: 550px; margin: auto">
<img style="width: 200px; float: right;" src="{{asset('images/cirkevFace.png')}}">
<h2>Týždenný súhrn komentárov <small><a href="{{ url('/') }}">CirkevOnline.sk</a></small></h2>

    <div style="background: silver; padding: 10px;color: #890000; font-size: 14px;"></div>


    @foreach($posts as $post)
        <a href="{{ url($post->slug) }}"><h3>{{$post->title}}</h3></a>
        <p style="color: #8b8b8b">{!! str_limit( $post->rich_text, 250) !!} </p>

        <h3><strong>Komentáre k článku</strong></h3>
        <ul>
            @foreach($post->comments as $comment)
            <li style="margin-bottom: 15px;
    background: #d5d5d5; padding: 11px;color: #700000;
    border-radius: 8px;">{{ $comment->text }} <br>
            @endforeach
        </ul>
    @endforeach


    <div style="background: silver; padding: 10px;color: #890000; font-size: 14px;">

    <p>
   <a href="{{ url($post->user->id, $post->user->slug ) }}">Všetky vaše články:</a><br>
   <a href="{{ url('/login') }}">Prístup do svojho účtu</a><br>
   <a href="{{ url('password/reset') }}">Zabudnuté heslo</a><br>
    Potrebujem pomôcť:
</p>
    </div>
</div>