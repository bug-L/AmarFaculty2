@extends('layouts.app')

@section('title', 'Approve professors - ')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>Approve/Delete Professor requests:</h2>
            <form method="post" action="{{ route('massUpdateProfessors') }}" onsubmit="return confirm('Save Changes?');">
                {{ csrf_field() }}
                <table style="border: 1px solid black;">
                    <tr>
                        <th style="border: 1px solid black; padding: 5px;">Approve</th>
                        <th style="border: 1px solid black; padding: 5px;">Delete</th>
                        <th style="border: 1px solid black; padding: 5px;">Name</th>
                        <th style="border: 1px solid black; padding: 5px;">Uni</th>
                        <th style="border: 1px solid black; padding: 5px;">Department</th>
                        <th style="border: 1px solid black; padding: 5px;">Posted on</th>
                    </tr>    
                    {{-- UNAPPROVED REVIEWS --}}
                    @foreach($professors as $professor)
                    <tr style="border: 1px">
                        <td style="border: 1px solid black; padding: 5px;">
                            <label>
                                <input type="radio" name="professor-update[{{ $index }}]" value="approve" checked>
                                <span></span>
                            </label>
                        </td>
                        <td style="border: 1px solid black; padding: 5px;">
                            <label>
                                <input type="radio" name="professor-update[{{ $index++ }}]" value="delete">
                                <span></span>
                            </label>    
                        </td>
                        <td style="border: 1px solid black; padding: 5px;"><a href="/professors/{{ $professor->id }}">{{ $professor->name }}</td>
                        <td style="border: 1px solid black; padding: 5px;">{{ $professor->university->abbr }}</td>
                        <td style="border: 1px solid black; padding: 5px;">{{ $professor->department->name }}</td>
                        <td style="border: 1px solid black; padding: 5px;">{{ $professor->created_at }}</td>
                    </tr>
                    <input type="hidden" name="professor-id[]" value="{{ $professor->id }}">
                    @endforeach
                </table>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            {{$professors->links()}}

        </div>
    </div>
</div>
@endsection