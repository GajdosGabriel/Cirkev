Oznámenie o počte návštev z <h2>Cirkevonline.sk</h2>

<p>
    Váš článok, <a href="{{ route('post.show', [$post->id, $post->slug])}}"> <span style="font-size: 16px" >{{ $post->title }}</span></a>
</p>
dosiahol úspech. Čítalo ho viac ako <span style="font-size: 20px" ><strong> {{ $post->count_view }}</strong> </span>čitateľov. <br>
Gratulujeme. <br>

Zdieľaním článku na Facebooku získate ešte väčšiu návčtevnosť a obohatíte ešte viac ľudí.

<p>
    Text článku:
</p>

<p>
    {!! word_limiter( html_entity_decode(  $post->body, 800)) !!}
</p>


<p>
    Vaše všetky články:
    Prístup do svojho účtu získate<br>
    Zabudnuté heslo<br>
    Potrebujem pomôcť:
</p>