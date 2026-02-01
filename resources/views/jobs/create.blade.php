<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Job</title>
</head>

<body>
    <h1>Create New Job</h1>
    <form action="/jobs" method="POST">
        @csrf
        <label for="title">Job Title:</label>
        <input type="text" id="title" name="title" required placeholder="title">
        <br><br>
        <label for="description">Job Description:</label>
        <textarea id="description" name="description" required></textarea>
        <br><br>
        <button type="submit">Create Job</button>
</body>

</html>