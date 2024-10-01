<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>
<body>

<h2>MY APP ENVs</h2>

<table>
    <tr>
        <th>KEY</th>
        <th>VALUE</th>
    </tr>
    <tr>
        <td>APP_URL</td>
        <td>{{ env('APP_URL') }}</td>
    </tr>
    <tr>
        <td>AWS_BUCKET</td>
        <td>{{ env('AWS_BUCKET') }}</td>
    </tr>
    <tr>
        <td>DB_HOST</td>
        <td>{{ env('DB_HOST') }}</td>
    </tr>
    <tr>
        <td>DB_USERNAME</td>
        <td>{{ env('DB_USERNAME') }}</td>
    </tr>
    <tr>
        <td>IS_SECURE</td>
        <td>{{ isSecure() }}</td>
    </tr>
</table>

</body>
</html>
