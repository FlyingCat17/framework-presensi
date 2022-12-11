@extends('templates/header')
<body>
    <h6>{{ title }}</h6>
    <h6>{{ user->id }}</h6>
    <h6>{{ user->username }}</h6>
    <h6>{{ user->email }}</h6>
    <h6>{{ user->password }}</h6>
    <h6>{{ user->first_name }}</h6>
    <h6>{{ user->last_name }}</h6>
    <h6>{{ user->created_at }}</h6>
    <h6>{{ user->updated_at }}</h6>

    <form action="logout" method="POST">
        <input type="submit" value="Logout">
    </form>

    <form action="form" method="POST">
        <input type="submit" value="Form">
    </form>

    <form action="save" method="POST">
        <input type="submit" value="Save">
    </form>

    <form action="update" method="POST">
        <input type="submit" value="Update">
    </form>

    <form action="delete" method="POST">
        <input type="submit" value="Delete">
    </form>

    <form action="me" method="GET">
        <input type="submit" value="Profile">
    </form>
</body>

</html>