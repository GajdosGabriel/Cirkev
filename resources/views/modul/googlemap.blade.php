
@if(!Request::has('search') && Request::is('/') && !app('request')->input('by'))

        <div class="d-flex justify-content-between">
            <h3 class="p-2">Mapa Slovenských kresťanov</h3>

            {!! Form::open( [ 'route' => 'search.index', 'method' => 'post' ]) !!}
                <label class="p-2">
                    <select onchange="this.form.submit()" name="mapUsers" class="form-control input-sm">
                        <option value="" selected>Všetci</option>
                        <option title="Praktická pomoc podľa profilu" value="diakon">Praktická pomoc</option>
                        <option title="Vysluhuje všetky sviatosti, sobáše, krsty a pohreby." value="church_employee">Duchovný z povolania</option>
                        <option title="Osoba ktorá má rohoľné svätenie." value="rehola">Rehoľnícke povolanie</option>
                        <option title="Osoba na misijnom poli, zvyčajne mimo SR." value="missioner">Misionár v zahraničí</option>
                        <option title="Je alebo bol pomocný duchovný." value="ministrant">Miništrant, pomocný duch.</option>
                        <option title="Ponúka domácich spoločenstiev, str. mládeže, ženské a biblické modlitebné a ďalšie." value="homegroupe">Domáce spoločenstvá</option>
                        <option title="Má v hlbokej vážnosti úctu k panne Márii." value="maria">Marianský ctiteľ</option>
                        <option title="Prakticky sa modlí za tlesné uzdravenie tela." value="healing">Mod. za uzdravenie</option>
                        <option title="Exorcizmus, modlitby za oslobodenie z duchovných poviazaní." value="exorsizmus">Mod. za oslobodenie</option>
                        <option title="Služba manželským párov a rodine." value=">mariageservice">Služba manželom, rodine</option>
                        <option title="Kresťan žijúci v zahraničí." value="christian_abroad">Kresťan žijúci v zahraničí</option>
                    </select>
                </label>
            {!! Form::close() !!}
        </div>


            <div  style="height: 400px; width: 100%; margin-bottom: 15px" >
                {!! Mapper::render() !!}
            </div>


    @section('side')
        <div id="marker"></div>
        @include('events.eventsModul')
        @parent
    @endsection







@section('script')
<script>

    function showProfile(data)
        {
            console.log("Data ", data);
            document.getElementById("marker").innerHTML =

                '<div class="card mb-3 border border-success">'+
                        '<div class="card-header bg-success text-center text-white">'+data.firstName+ ' '+data.lastName+'</div>'+
                        '<div style="padding-left: 10px;">'+
//                '<div class="zobrazit'+data.verim+'"><i class="fa fa-plus-circle"></i> Som praktizujúci kresťan.</div>'+
                '<div class="zobrazit1"><i class="fa fa-plus-circle"></i> '+data.info_text+'</div>'+

                            '<img style="width: 120px;display:block; margin:auto; border-radius: 5px;" src={{ Storage::url('users') }}/'+data.id+ '/small-' +data.avatar+'>'+
                            '<div class="zobrazit'+data.healing+'"><i class="fa fa-plus-circle"></i> Mod. za uzdravenie</div>'+
                            '<div class="zobrazit'+data.exorsizmus+'"><i class="fa fa-plus-circle"></i> Mod. za Oslobodenie</div>'+
                            '<div class="zobrazit'+data.diakon+'"><i class="fa fa-plus-circle"></i> Diakon prak. pomoc</div>'+
                            '<div class="zobrazit'+data.mariageservice+'"><i class="fa fa-plus-circle"></i> Služba manželom, rodine</div>'+
                            '<div class="zobrazit'+data.homegroupe+'"><i class="fa fa-plus-circle"></i> Domáce spoločenstvo</div>'+
                            '<div class="zobrazit'+data.church_employee+'"><i class="fa fa-plus-circle"></i> Duchovný z povolania, sobáše, krsty, pohreby sviatosti.</div>'+
                            '<div class="zobrazit'+data.rehola+'"><i class="fa fa-plus-circle"></i> Duchovný v rehoľnom ráde</div>'+
                            '<div class="zobrazit'+data.ministrant+'"><i class="fa fa-plus-circle"></i> Miništrant je, alebo bol</div>'+
                            '<div class="zobrazit'+data.missioner+'"><i class="fa fa-plus-circle"></i> Misionár mimo Slovenska</div>'+
                            '<div class="zobrazit'+data.maria+'"><i class="fa fa-plus-circle"></i> Marianský ctiteľ</div>'+
                            '<div class="zobrazit'+data.christian_abroad+'"><i class="fa fa-plus-circle"></i> Kresťan žijúci v zahraničí</div>'+
//                            '<div class="label label-warning">Podrobnosti</span>'+
                            '<a href="{{ url('user') }}/'+data.slug+'"><span class="label label-danger">Profil</div></a>'+
//                            '<div class="label label-info">Pošli správu</div>'+

                        '</div>'+
                '</div>';
        }

    function hideProfile()
        {
        document.getElementById("marker").innerHTML = '<h6></h6>';
        }


</script>

@endsection

@endif
