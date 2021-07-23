@extends('layouts.app')

@section('title', 'Departments - ')

@section('content')


    @if($departments->count() > 0)
    <h2>All Departments: </h2>
    <table style="border: 1px solid black;">
        <tr>
            <th style="border: 1px solid black; padding: 5px;">Department Name</th>
            <th style="border: 1px solid black; padding: 5px;">Date Added</th>
            <th style="border: 1px solid black; padding: 5px;">Edit</th>
        </tr>    
        @foreach($departments as $department)
        <tr style="border: 1px">
            <td style="border: 1px solid black; padding: 5px;">{{ $department->name }}</td>
            <td style="border: 1px solid black; padding: 5px;">{{ $department->created_at }}</td>
            <td style="border: 1px solid black; padding: 5px;"><a href="/departments/{{ $department->id }}/edit">Edit</a></td>
        </tr>
        @endforeach
    </table>
    @else
        <b>NO UNIVERSITIES ON SYSTEM!</b>
    @endif

@endsection