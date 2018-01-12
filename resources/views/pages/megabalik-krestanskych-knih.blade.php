@extends('layouts.app')
@section('autor', isset ( $post->user->firstName) ?  strip_tags($post->user->firstName) : 'Gabriel Gajdoš' )


@section('title', $title)


@section('content')

	<section class="">

<h1>Knihy na stiahnutie</h1>
        <div>
            <table border="6" style="border: 6px solid #0033ff; padding: 24px; width: 661px; height: 1275px; margin: auto;">
                <tbody>
                <tr>
                    <td>
                        <div>&nbsp;</div>
                        <h2>1. R&oacute;movia v n&aacute;boženskom kontexte<img src=" {{ asset('images/boh-medzi-barierami.jpg') }} " alt="boh-medzi-barierami" width="127" height="198" style="float: right;" /></h2>
                        <p>Boh medzi bari&eacute;rami. Odborne spracovan&aacute; publik&aacute;cia ktor&aacute; mapuje n&aacute;božensk&uacute; pr&aacute;cu medzi R&oacute;mami n<span>aprieč v&scaron;etk&yacute;ch denomin&aacute;ciami</span>. Na 88 str&aacute;nach sa zaober&aacute; v&scaron;etk&yacute;mi ohniskami r&oacute;mskej pr&aacute;ce na Slovensku. Podrobn&eacute; &scaron;tatistiky, jednotliv&yacute;ch denomin&aacute;ci&iacute;, historick&yacute; v&yacute;voj pr&aacute;ce a jej perspekt&iacute;vy. Projekt vyžiadan&yacute; EU.</p>
                        <p><img src="{{ asset('images/plus.png') }}" alt="plus" width="30" height="30" style="display: block; margin-left: auto; margin-right: auto;" /></p>
                        <h2>&nbsp;</h2>
                        <h2>2. Zauj&iacute;mavosti zo z&aacute;kulisia Vatik&aacute;nu a p&aacute;pežov&nbsp;<img src="{{ asset('images/vatikan.jpg') }}" alt="vatik&aacute;n" width="125" height="145" style="float: right;" /></h2>
                        <p>Zauj&iacute;mav&yacute; v&yacute;ber P&auml;ťdesiat zauj&iacute;mavosti zo z&aacute;kulisia Vatik&aacute;nu, p&aacute;pežov&yacute;ch osobn&yacute;ch postrehov, z&aacute;ľub a v&yacute;rokov, n&aacute;sledn&iacute;ctva a pr&aacute;va, hist&oacute;rie, zauj&iacute;mavosti z 2. Svet. Vojny, o vatik&aacute;nskych knih&aacute;ch, počtu obyvateľom k&uacute;rie a pod.</p>
                        <p><img src="{{ asset('images/plus.png') }}" alt="plus" width="30" height="30" style="display: block; margin-left: auto; margin-right: auto;" /></p>
                        <h2>3. Čo sa deje vo Vatik&aacute;ne v pr&iacute;pade p&aacute;pežovej smrti<img src="{{ asset('images/co-sa-deje.jpg') }}" alt="co-sa-deje" width="128" height="136" style="float: right;" /></h2>
                        <p>Jozef Kov&aacute;čik spracoval podľa zahraničn&yacute;ch materi&aacute;lov kr&aacute;tky prehľad najnevyhnutnej&scaron;&iacute;ch krokov ktor&eacute; sa musia udiať v pr&iacute;pade smrti p&aacute;peža.</p>
                        <p><img src="{{ asset('images/plus.png') }}" alt="plus" width="30" height="30" style="display: block; margin-left: auto; margin-right: auto;" /></p>
                        <h2>&nbsp;</h2>
                        <h2>4. Kniha "Izrael 101"<img src="{{ asset('images/e-book.png') }}" alt="e-book" width="135" height="170" style="float: right;" /></h2>
                        <p>Jedna z najobsiahlej&scaron;&iacute;ch zdrojov dostupn&yacute;ch pre lep&scaron;ie pochopenie Izraela, jeho geopolitick&yacute;ch dej&iacute;n a konflikt na Bl&iacute;zkom v&yacute;chode. T&uacute;to knihu by ste si mali preč&iacute;tať.<br />Kniha je v angličtine, obsahuje množstvo farebn&yacute;ch obr&aacute;zkov, m&aacute;p, orgin&aacute;lnych fotografi&iacute;. Na viac ako 40 stran&aacute;ch n&aacute;jdete pop&iacute;san&eacute; dejiny a s&uacute;časnosť Izraela.</p>
                        <p><img src="{{ asset('images/plus.png') }}" alt="plus" width="30" height="30" style="display: block; margin-left: auto; margin-right: auto;" /></p>
                        <h2>5. D&yacute;ka a kr&iacute;ž</h2>
                        <p><img src="{{ asset('images/dyka_a_kriz.jpg') }}" alt="dyka a kriz" width="126" height="177" style="float: right;" /></p>
                        <p>Hist&oacute;ria hnutia Teen Challenge sa začala p&iacute;sať v roku 1958, keď Reverend David Wilkerson kr&aacute;čal ulicami Brooklynu v New Yorku a bol zhrozen&yacute;, koľko mlad&yacute;ch ľud&iacute; zneuž&iacute;va alkohol a in&eacute; drogy. Hnut&yacute; ľ&uacute;tosťou nad ich osudmi za rozhodol veci zmeniť. Skončil s pr&aacute;cou kazateľa v Pensylv&aacute;nii a presťahoval sa do New Yorku. Ako pastor spočiatku pracoval s mlad&yacute;mi členmi newyorsk&yacute;ch gangov. T&uacute;žil im priniesť vn&uacute;torn&yacute; pokoj a slobodu od n&aacute;silia. Nesk&ocirc;r začal p&ocirc;sobiť aj medzi ľuďmi z&aacute;visl&yacute;mi na alkohole a in&yacute;ch n&aacute;vykov&yacute;ch l&aacute;tkach. Od roku 1960, kedy bolo otvoren&eacute; prv&eacute; centrum Teen Challenge v Brooklyne na Clinton Avenue, sa hnutie roz&scaron;&iacute;rilo po celom svete. David Wilkerson založil nesk&ocirc;r aj celosvetov&uacute; evanjelizačn&uacute; organiz&aacute;ciu s n&aacute;zvom World Challenge.</p>
                        <p><img src="{{ asset('images/plus.png') }}" alt="plus" width="30" height="30" style="display: block; margin-left: auto; margin-right: auto;" /></p>
                        <h2>6. DĚJINY DES&Aacute;TKŮ<img src="{{ asset('images/dejiny-desiatkov.jpg') }}" alt="dejiny-desiatkov" width="127" height="180" style="float: right;" /></h2>
                        <p>Kvalitn&aacute; e-publik&aacute;cia od JIŘ&Iacute; DOLEŽELA, ktor&yacute; na 136 stran&aacute;ch opisuje dejiny desiatkov. Autor mapuje historick&yacute; v&yacute;voj d&aacute;vania desiatkov, použ&iacute;va mnoho obr&aacute;zkov. Pracuje s historick&yacute;mi faktami a biblick&yacute;m pohľadom. Jazyk CZ, 136 str&aacute;n.</p>
                        <p>&nbsp;<img src="{{ asset('images/plus.png') }}" alt="plus" width="30" height="30" style="display: block; margin-left: auto; margin-right: auto;" /></p>
                        <h2>&nbsp;7. Neprem&aacute;rnite svoj ​​život<img src="{{ asset('images/Nepremarni_svoj_zivot.jpg') }}" alt="Nepremarni svoj zivot" width="126" height="176" style="border: 1px solid #000000; float: right;" /></h2>
                        <p><br />Boh n&aacute;s stvoril na to, aby sme žili s jedinou v&aacute;&scaron;ňou: v&aacute;&scaron;ňou radostne zobrazovať Jeho najvy&scaron;&scaron;ia vzne&scaron;enosť vo v&scaron;etk&yacute;ch oblastiach života. Prem&aacute;rnen&yacute; život je život bez tejto v&aacute;&scaron;ne. Boh n&aacute;s povol&aacute;va k tomu, aby sme sa modlili, prem&yacute;&scaron;ľali, sn&iacute;vali, pl&aacute;novali a pracovali nie na vyv&yacute;&scaron;enie n&aacute;s samotn&yacute;ch, ale k jeho oslave vo v&scaron;etk&yacute;ch oblastiach n&aacute;&scaron;ho života.</p>
                        <p>&nbsp;</p>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <p style="text-align: center;"><span style="font-size: 14pt;"><strong>&nbsp;</strong></span></p>
        <p style="text-align: center;"><span style="font-size: 14pt;"><strong>&nbsp;<span style="color: #313030;">Tento "Mega pack bal&iacute;k" v&aacute;m bude zaslan&yacute;<br /></span> </strong><strong style="font-size: 14pt;"><span>po vyplnen&iacute; kontaktn&yacute;ch &uacute;dajov.</span></strong> </span></p>





	</section>




@endsection