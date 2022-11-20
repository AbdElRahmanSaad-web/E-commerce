@extends('admin_layout.app')

@section('body')
    @if (session()->has('message'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            {{ session()->get('message') }}
        </div>
    @endif

    <h1>Add Catagory</h1>
    <div class="container text-center mt-5">
        <form class="w-50 offset-3" action="{{ route('add.catagory') }}" method="POST">
            @csrf
            <label>Catagory Name: </label>
            <input type="text" class="form-control mb-3" name='catagory' id="catagory_input" placeholder="Enter Catagory Name">
            {{-- <input type="submit" value="Add Catagory" class="btn btn-primary"> --}}
            <button type="submit" class="btn btn-primary">Add Catagory</button>
        </form>

        @php($n = 1)
        <table class="table table-dark table-striped mt-5">
            <thead>
                <th>#</th>
                <th>Catagory Name</th>
                <th>Actions</th>
            </thead>
            <tbody>
                @foreach ($catagories as $catagory)
                <tr>
                    <td>{{ $n++ }}</td>
                    <td>{{ $catagory->catagory_name }}</td>
                    <td>
                        @if(Auth::user()->usertype == '1')
                        <form action="{{ route('delete.catagory', $catagory->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button onclick="return confirm('Are you Sure To Delete This')" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                        </form>
                        @else
                            -
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
