<?php
if (isset($_GET["delete"])) {
    $delete = $_GET["delete"];
    $query = "DELETE FROM `user` WHERE id =$delete";
    $result = mysqli_query($connection, $query);
}
?>
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Avatar</th>
            <th>Name</th>
            <th>Password</th>
            <th>Email</th>
            <th>Role</th>
            <th>Change</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <!-- <tr>
                                <td>10</td>
                                <td>Nicejjss</td>
                                <td>Cach su dung PHP</td>
                                <td>PHP</td>
                                <td>Status</td>
                                <td>Image</td>
                                <td>Tags</td>
                                <td>Comments</td>
                                <td>10/12/2022</td>
                            </tr> -->
        <?php
        $query = "SELECT * FROM `user`";
        $result = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            $userid = $row["id"];
            $username = $row["name"];
            $useremail = $row["email"];
            $userpassword = $row["password"];
            $useravt = $row["image"];
            $userrole = $row["role"];
        ?>
            <tr>
                <td><?php echo $userid; ?></td>
                <td> <img width="64" height="64" src="../images/avatar/<?php echo $useravt; ?>" alt=""></td>
                <td> <?php echo $username; ?></td>
                <td><?php echo $userpassword; ?></td>
                <td><?php echo $useremail; ?></td>
                <td><?php echo $userrole; ?></td>
                <td>
                <?php  if($userrole =="admin"){
                    echo "<a href='./users.php?source=edit user&admin=true&userid=${userid}'>Admin</a></td>";
                }else{
                    echo "<a href='./users.php?source=edit user&admin=false&userid=$userid'>User</a></td>";
                }
                ?>    
                </td>
                <td> <a href="./users.php?delete=<?php echo $userid ?>">DELETE</a></td>
            </tr>
        <?php }
        ?>
    </tbody>
</table>