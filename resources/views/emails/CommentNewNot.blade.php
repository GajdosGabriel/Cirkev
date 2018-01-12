<strong>Pribudol nový komentár.</strong>
<div style="background: silver; padding: 10px;color: #890000; font-size: 14px;">{{ $comment->text }}</div>

<p>na Váš článok  <a href="www.cirkevonline.sk/{{$comment->post->slug}}">{{ $comment->post->title }}</a><br>


   {{ str_limit( $comment->post->text, 800) }}<br>
    <a href="www.cirkevonline.sk/{{$comment->post->slug}}">zobraziť celý článok</a>
</p>

Doteraz si článok prečítalo {{ $comment->post->count_view }} čitateľov.<br>

<p>
    Vaše všetky články:
    Prístup do svojho účtu získate<br>
    Zabudnuté heslo<br>
    Potrebujem pomôcť:
</p>

