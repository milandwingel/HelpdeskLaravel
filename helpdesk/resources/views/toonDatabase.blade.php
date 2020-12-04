<!doctype html>
<html lang="ne">
<head>
    <title>Document</title>
</head>
<body>
<table style="width:100%">
    <tr>
        <th>id</th>
        <th>naam</th>
        <th>created_at</th>
        <th>updated_at</th>
    </tr>
    @foreach($items as $key => $data)
    <tr>
        <td>{{$data->id}}</td>
        <td>{{$data->naam}}</td>
        <td>{{$data->created_at}}</td>
        <td>{{$data->updated_at}}</td>
    </tr>
    @endforeach
</table>
</body>
</html>