<?php
require('libs/db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search user</title>

    <link rel="stylesheet" type="text/css" href="asset/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="asset/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="asset/css/local.css" />
    <link rel="stylesheet" type="text/css" href="asset/css/delete.css" />

    <script type="text/javascript" src="asset/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="asset/js/bootstrap.min.js"></script>
</head>
<body>
<div id="wrapper">
    <?php
    include("common.php");
    ?>
    <div class="container">
        <div class="row" id="search-user">
            <form method="post" action="searchUser.php">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-7">
                        <label>
                            <input class="form-control form-control-lg form-control-borderless" type="search" placeholder="Search film for name, director, actor,..." style="width: 600px"  name="qry">
                        </label>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-lg btn-primary" type="submit" name="button_search" style="padding: 8px">Search</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="row" id="list-user">
            <div class="col-md-1"></div>
            <div class="col-md-8">
                <!-- get from database -->
                <?php
                if(isset($_POST["button_search"])){
                $name = isset($_POST["qry"]) ? $_POST["qry"] : '';

                $sql = "SELECT * FROM users WHERE username LIKE '%{$name}%'";

                $result = mysqli_query($link, $sql);
                if (mysqli_num_rows($result) > 0) { ?>
                <!-- output data of each row -->
                <table class="table" style="margin: 10px 0px">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Username</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)) {  ?>
                        <tr>
                            <th> <?php echo $row["id"] ?> </th>
                            <th> <?php echo $row["username"] ?> </th>
                            <th> <?php echo $row["phone"] ?> </th>
                            <td>
                                <button type="button" class="btn btn-info" name="edit" onclick="edit(this)">Edit</button>
                                <button type="button" class="btn btn-danger" name="delete" onclick="del(this)">Delete</button>
                            </td>
                        </tr>
                        <?php
                    }
                    } else {
                        echo "No user like ".$name;
                    }
                    }
                    //                    mysqli_close($link);
                    ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
<script>
    function edit(params) {
        var tr = params.parentElement.parentElement;
        var td0= tr.cells.item(0).innerHTML;
        td0 = td0.replace(' ','' ); //id của user có space ???
        location.href= "editUser.php?id=" + td0;
    };
    function del(params) {
        if(confirm("Bạn có chắc muốn xóa user này?")){
            var tr = params.parentElement.parentElement;
            var td0= tr.cells.item(0).innerHTML;
            td0 = td0.replace(' ','' ); //id của user có space ???
            location.href= "deleteUser.php?id=" + td0;
        }
    };
</script>
</body>
</html>
