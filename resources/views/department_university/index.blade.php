@extends('layouts.app')

@section('title', 'Departments - ')

@section('content')

    @if($universities->count() > 0)
    <h2>All University Department Relations: </h2>
    <table style="border: 1px solid black;">
        <tr>
            <th style="border: 1px solid black; padding: 5px;">University</th>
            <th style="border: 1px solid black; padding: 5px;">Department</th>
        </tr>    
        @foreach($universities as $university)
            @foreach($university->departments as $department)
            <tr>
                <td style="border: 1px solid black;  padding: 5px;">{{ $university->name }}</td>
                <td style="border: 1px solid black;  padding: 5px;">{{ $department->name }}</td>
            </tr>
            @endforeach
        @endforeach
    </table>
    @else
        <b>NO University Department Relations!</b>
    @endif

@endsection