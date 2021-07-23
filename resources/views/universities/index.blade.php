@extends('layouts.app')

@section('title', 'Universities - ')

@section('content')


    @if($universities->count() > 0)
    <h2>All Universities: </h2>
    <table style="border: 1px solid black;">
        <tr>
            <th style="border: 1px solid black; padding: 5px;">University Name</th>
            <th style="border: 1px solid black; padding: 5px;">Abbreviation</th>
            <th style="border: 1px solid black; padding: 5px;">Date Added</th>
            <th style="border: 1px solid black; padding: 5px;">Edit</th>
        </tr>    
        @foreach($universities as $university)
        <tr style="border: 1px">
            <td style="border: 1px solid black; padding: 5px;">{{ $university->name }}</td>
            <td style="border: 1px solid black; padding: 5px;">{{ $university->abbr }}</td>
            <td style="border: 1px solid black; padding: 5px;">{{ $university->created_at }}</td>
            <td style="border: 1px solid black; padding: 5px;"><a href="/universities/{{ $university->id }}/edit">Edit</a></td>
        </tr>
        @endforeach
    </table>
    @else
        <b>NO UNIVERSITIES ON SYSTEM!</b>
    @endif

@endsection