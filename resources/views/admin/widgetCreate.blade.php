@extends('layouts.app')


@section('title', isset($title) ? strip_tags($title) : 'Vytvoriť reklamu')


@section('content')

    <h1>Vytvoriť Reklamu</h1>

    <table class="table">
        <thead>
        <tr>
        <th>ID</th>
        <th>Názov</th>
        <th>Pozícia</th>
        <th>Začiatok</th>
        <th>Koniec</th>
        <th>Publikované</th>
        <th>Mobil</th>
        <th>Počet</th>
        <th>Zmazať</th>
        </tr>
        </thead>

        <tbody>

        @foreach( $widgets as $widget)
            <tr>
                <td>{{ $widget->id }}</td>
                <td><a href="{{ url('reklama/edit', $widget->id) }}">{{ $widget->title }}</a></td>
                <td>{{ $widget->position }}</td>
                <td>{{ $widget->startPublished }}</td>
                <td>{{ $widget->endPublished }}</td>
                <td>{{ $widget->published }}</td>
                <td>{{ $widget->showMobile }}</td>
                <td>{{ $widget->count }}</td>
                <td>
                    <form action="{{ route('zmazat', $widget->id) }}" method="post">
                        {{ csrf_field() }} {{ method_field('DELETE') }}
                    <button type="submit" >X</button>
                    </form>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>





@endsection


@section('side')

    <form action="{{ route('reklama') }}" method="post" enctype="multipart/form-data" >
        {{ csrf_field() }}


        <div class="form-group">
            <label for="">Názov</label>
            <input type="text" name="title" required class="pull-right">
        </div>


        <div class="form-group">
            <label for="">Typ</label>
            <input type="text" name="type" required class="pull-right">
        </div>

        <div class="form-group">
        <label>Text reklamy</label>
        <textarea name="text"   style="width: 100%" rows="6" ></textarea>
            </div>
        <div class="form-group">
            <label for="">Nahrať obrázok</label>
            <input type="file" name="picture" accept="image/*" >
        </div>

        <div class="form-group">
            <label for="">Link na stránku</label>
            <input type="text" name="link" class="pull-right">
        </div>


    <div class="form-group">
        <label for="">Publikovať</label>
        <select name="published" required >
            <option value="Yes">Ano</option>
            <option value="No">Nie</option>
        </select>
    </div>

        <div class="form-group">
            <label for="">Začiatok Publikovania</label>
            <input type="date" name="startPublished" class="pull-right">
        </div>

        <div class="form-group">
            <label for="">Koniec Publikovania</label>
            <input type="date" name="endPublished" class="pull-right">
        </div>


        <div class="form-group">
            <label for="">Pozícia</label>
            <select name="position" required >
                <option value="Side">Side</option>
                <option value="PostDown">Články Dole</option>
                <option value="PostUp" disabled>Články Hore</option>
            </select>
        </div>


        <div class="form-group">
            <label for="">Mobil</label>
            <select name="showMobile" required >
                <option value="Yes">Áno</option>
                <option value="No">Nie</option>
            </select>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Uložiť</button>
        </div>

    </form>


@endsection

