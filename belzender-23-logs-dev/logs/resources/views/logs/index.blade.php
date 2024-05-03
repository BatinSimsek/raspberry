@extends('logs.layout')

@section('content')
    <div onload="message()" class="container mt-4">
        <h2>Logs</h2>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Log Message</th>
                <th>Timestamp</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($logs as $log)
                <tr>
                    <td>{{ $log->id }}</td>
                    <td>{{ $log->description }}</td>
                    <td>{{ $log->created_at }}</td>
                    <td>
                        <form action="{{ route('logs.destroy', $log->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Weetje zeker dat je het wil verwijderen?')">Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
