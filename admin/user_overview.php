<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Overview</title>
        <link rel="stylesheet" href="../css/styles.css">
        <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>  

    </head>
    <body>
        <?php
            include("../admin/view_user_sql.php");
            $users = getUsers();
            include("../includes/header_one.php");
        ?>
    <main>
        <h1>User Overview</h1>

        <!--Button-->
        <form action="create_user.php">
            <input type="submit" value="Create New User">
        </form>

        <div class="table-container">
            <table>
                <!--table headers-->
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Branch</th>
                        <th>Actions</th>

                    </tr>
                </thead>

                <!--table body-->
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo $user['name']; ?></td>
                            <td><?php echo $user['phone_number']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td><?php echo $user['role']; ?></td>
                            <td><?php echo $user['username']; ?></td>
                            <td><?php echo $user['password']; ?></td>
                            <td><?php echo $user['branch_name']; ?></td>
                            <td class="actions">
                            <a href="../admin/update_user_overview.php?userID=<?php echo $user['user_id']; ?>">Update</a>
                            <a href="../admin/remove_user.php?userID=<?php echo $user['user_id']; ?>">Remove</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
    </body>
</html>