<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
 <table>
     <thead>
        <tr>
            <th>Username</th>
            <th>Order No.</th>
            <th>Created</th>
        </tr>
     </thead>
     <tbody>
        @foreach ($datas as $v)
        <tr>
            <td>{{$v->username}}</td>
            <td>{{$v->order_number}}</td>
            <td>{{$v->created_at}}</td>
        </tr>
        @endforeach
     </tbody>
 </table>
</body>
</html>