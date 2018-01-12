@extends('layouts.app')

@section('autor', isset ( $post->user->firstName) ?  strip_tags($post->user->fullname) : 'Gabriel Gajdoš' )

@section('title', isset($title) ? strip_tags($title) : 'Najnovšie príspevky')



@section('content')

    <section class="post-list">
        <h1 class="box-heading text-muted my-4">
            {!! $title or "Blog Cirkev Online.sk" !!}
        </h1>


        <table class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Deleted_at</th>
                <th>Reading</th>
                <th>Author</th>
                <th>Tools</th>
            </tr>
            </thead>
            <tbody>

            @forelse($trashed_posts as $trashed_post)

                <tr>
                    <td><strong>{{ $trashed_post->id }}</strong></td>
                    <td>{{ $trashed_post->title }} <small class="text-danger"><i>(trashed)</i></small></td>
                    <td>{{ $trashed_post->deleted_at }}</td>
                    <td>{{ $trashed_post->count_view }}x</td>
                    <td>{{ $trashed_post->user->fullName }}</td>

                    <td>
                        <a href=""><i class="icon fa fa-eye fa-lg fa-default" title="Detail"></i></a>
                        <a href="{{ route('trash.restore', $trashed_post->id) }}"><i class="icon fa fa-refresh fa-lg fa-green" title="Restore"></i></a>
                        <a href="{{ route('trash.forceDelete', $trashed_post->id) }}"><i class="icon fa fa-trash fa-lg fa-red" title="Delete"></i></a>
                    </td>
                </tr>

            @empty

                <tr>
                    <td><strong>No trashed posts</strong></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

            @endforelse

            </tbody>
        </table>

    </section>


@endsection




