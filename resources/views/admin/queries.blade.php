@extends('layouts.app')

@section('title', 'Professors - ')

@section('content')


 
    <h2>All professors: </h2>
    <table style="border: 1px solid black;">
        <tr>
            <th style="border: 1px solid black; padding: 5px;">Query</th>
            <th style="border: 1px solid black; padding: 5px;">Uni</th>
            <th style="border: 1px solid black; padding: 5px;">Count</th>
            <th style="border: 1px solid black; padding: 5px;">IP</th>
            <th style="border: 1px solid black; padding: 5px;">Date</th>

        </tr>    
        @foreach($queries as $query)
        <tr style="border: 1px">
            <td style="border: 1px solid black; padding: 5px;">{{ $query->query }}</td>
            <td style="border: 1px solid black; padding: 5px;">{{ $query->university_id }}</td>
            <td style="border: 1px solid black; padding: 5px;">{{ $query->match_count }}</td>
            <td style="border: 1px solid black; padding: 5px;">{{ $query->user_ip }}</td>
            <td style="border: 1px solid black; padding: 5px;">{{ $query->created_at }}</td>
        </tr>
        @endforeach
    </table>
   
@endsection