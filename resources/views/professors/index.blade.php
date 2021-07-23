@extends('layouts.app')

@section('title', 'Professors - ')

@section('content')


    @if($professors->count() > 0)
    <h2>All professors: </h2>
    <table style="border: 1px solid black;">
        <tr>
            <th style="border: 1px solid black; padding: 5px;">Professor Name</th>
            <th style="border: 1px solid black; padding: 5px;">University</th>
            <th style="border: 1px solid black; padding: 5px;">Department</th>
            <th style="border: 1px solid black; padding: 5px;">Posted On</th>
            <th style="border: 1px solid black; padding: 5px;">Approved</th>

        </tr>    
        @foreach($professors as $professor)
        <tr style="border: 1px">
            <td style="border: 1px solid black; padding: 5px;"><a href="/professors/{{ $professor->id }}">{{ $professor->name }}</a><br></td>
            <td style="border: 1px solid black; padding: 5px;">{{ $professor->university->name }}</td>
            <td style="border: 1px solid black; padding: 5px;">Department of {{ $professor->department->name }}</td>
            <td style="border: 1px solid black; padding: 5px;">{{ $professor->created_at }}</td>
            <td style="border: 1px solid black; padding: 5px;">{{ $professor->approved }}</td>
        </tr>
        @endforeach
    </table>
    {{ $professors->links() }}
    @else
        <b>NO PROFESSORS ON SYSTEM!</b>
    @endif

@endsection