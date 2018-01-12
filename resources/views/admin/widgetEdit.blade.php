@extends('layouts.app')


@section('title', isset($title) ? strip_tags($title) : 'Vytvoriť reklamu')


@section('content')

    <h1>Upraviť Reklamu</h1>

    <table class="table">
        <thead>
        <tr>
        <th>ID</th>
        <th>Názov</th>
        <th>Typ</th>
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
                <td>{{ $widget->title }}</td>
                <td>{{ $widget->type }}</td>
                <td>{{ $widget->position }}</td>
                <td>{{ $widget->startPublished }}</td>
                <td>{{ $widget->endPublished }}</td>
                <td>{{ $widget->published }}</td>
                <td>{{ $widget->showMobile }}</td>
                <td>{{ $widget->count }}</td>
                <td>
                    {{--<form action="{{ route('zmazat', $widget->id) }}" method="post">--}}
                        {{--{{ csrf_field() }}--}}
                    {{--<button type="submit" >X</button>--}}
                    {{--</form>--}}
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>

    <a href="{{ route('reklama') }}"><button class="btn btn-primary pull-right ">Späť</button></a>





@endsection


@section('side')

    <form action="{{ route('update', $widget->id ) }}" method="post">
        {{ csrf_field() }}


        <div class="form-group">
            <label for="">Názov</label>
            <input type="text" value="{{ old('title', $widget->title) }}" name="title" required class="pull-right">
        </div>


        <div class="form-group">
            <label for="">Typ</label>
            <input type="text" value="{{ old('type', $widget->type) }}" name="type" required class="pull-right">
        </div>
        <div class="form-group">
        <label>Text reklamy</label>
        <textarea name="text"   style="width: 100%" rows="6" required>{{ old('text', $widget->text) }}</textarea>
            </div>

    <div class="form-group">
        <label for="">Publikovať</label>
        <select name="published" required >
            <option {{ ($widget->published == 'Yes') ? 'selected' : '' }} value="Yes">Ano</option>
            <option {{ ($widget->published == 'No') ? 'selected' : '' }} value="No">Nie</option>
        </select>
    </div>

        <div class="form-group">
            <label for="">Začiatok Publikovania</label>
            <input type="date" name="startPublished" value="{{ $widget->startPublished }}" class="pull-right">
        </div>

        <div class="form-group">
            <label for="">Koniec Publikovania</label>
            <input type="date" name="endPublished" value="{{ $widget->endPublished }}" class="pull-right">
        </div>


        <div class="form-group">
            <label for="">Pozícia</label>
            <select name="position" required >
                <option {{ ($widget->position == 'Side') ? 'selected' : '' }} value="Side">Side</option>
                <option {{ ($widget->position == 'PostDown') ? 'selected' : '' }} value="PostDown">Články Dole</option>
                <option {{ ($widget->position == 'PostUp') ? 'selected' : '' }} value="PostUp" disabled>Články Hore</option>
            </select>
        </div>


        <div class="form-group">
            <label for="">Moblil</label>
            <select name="showMobile" required >
                <option {{ ($widget->showMobile == 'Yes') ? 'selected' : '' }} value="Yes">Áno</option>
                <option {{ ($widget->showMobile == 'No') ? 'selected' : '' }} value="No">Nie</option>
            </select>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Uložiť</button>
        </div>

    </form>


@endsection

