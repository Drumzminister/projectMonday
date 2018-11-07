
    @extends('layouts.listing')
   @section('listing.content')
        <div class="row">
            @if(session('message'))
                <div class="col-md-12">
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                </div>
            @endif
        </div>
    <br/>

    <div role="main" class="cover">
        @if ($assignments->count() > 0)
            <div class="row">
                <div class="col-md-12">
                    <h3>
                       Assignments Created
                        @include('includes.error')
                    </h3>
                </div>
            </div>
        <div class="table-responsive">
            <table class="table table-hover table-dark">
                <thead>
                    <tr>
                        <th scope="col">S/N</th>
                        <th scope="col"> Title</th>
                        {{-- <th scope="col "> Description</th> --}}
                        <th scope="col">Class</th>
                        <th scope="col">Level</th>
                        <th scope="col">Submissions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($assignments as $key => $assignment)
                    <tr>
                        <th scope="row">{{ $key+1 }}</th>
                        <td>{{ $assignment->title }}</td>
                        {{-- <td class="text-left">{{ $assignment->description }}</td> --}}
                        <td>{{$assignment->class->name}}</td>
                        <td>{{$assignment->class->level->level}}</td>
                    <td> <a href="/assignments/submitted/{{$assignment->id}}" class="btn btn-success">See Submissions</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <h1>No Assignments created for this class yet. Check back.</h1>
        @endif

    </div>
   @endsection


