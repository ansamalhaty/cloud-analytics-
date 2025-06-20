<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Documents</title>
</head>
<body>
    <h1>Search Documents</h1>
    <form action="{{ url('/search') }}" method="GET">
        <input type="file" name="keyword" placeholder="Enter keyword" required>
        <button type="submit">Search</button>
    </form>

    @if(!empty($matchingFiles))
        <h2>Matching Files</h2>
        <ul>
            @foreach($matchingFiles as $file)
                <li>{{ $file }}</li>
            @endforeach
        </ul>
    @endif
</body>
</html>