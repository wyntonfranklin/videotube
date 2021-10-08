<?php
require_once("includes/header.php");
require_once("includes/classes/Account.php");
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/SettingsFormProvider.php");
require_once("includes/classes/UserListingProvider.php");
require_once("includes/classes/Constants.php");

if(!User::isLoggedIn()) {
    header("Location: signIn.php");
}

$detailsMessage = "";
$passwordMessage = "";
$allUsers = new UserListingProvider($con, $userLoggedInObj);

$users = $allUsers->getUsersAsArray();
?>
<style>

</style>
<script src="assets/js/userManagementActions.js?v=0.1"></script>

<div class="settingsContainer column">

    <div class="formSection">
        <div class="message">
            User Management - List of all users
            <div style="float: right;">
                <a onclick="editUserAction(null, null);" class="btn btn-sm btn-primary">Add New User</a>
            </div>
        </div>
    </div>

    <div class="">
        <div class="">
            <div class="row">
                <div class="col">
                    <table class="table" id="table">
                        <thead>
                        <tr>
                            <td>Username</td>
                            <td>First Name</td>
                            <td>Last Name</td>
                            <td>Role</td>
                            <td>Email</td>
                            <td>Created On</td>
                            <td>Actions</td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($users as $user):?>
                            <tr>
                                <td><?php echo $user["username"];?></td>
                                <td><?php echo $user["firstName"];?></td>
                                <td><?php echo $user["lastName"];?></td>
                                <td><span class="badge badge-secondary"><?php echo strtoupper($user["role"]);?></span></td>
                                <td><?php echo $user["email"];?></td>
                                <td><?php echo $user["signUpDate"];?></td>
                                <td>
                                    <a href="javascript:void(0);" onclick="editUserAction(<?php echo $user["id"];?>, '<?php echo $user["username"];?>')"><img src="./assets/images/icons/edit.png" style="width: 20px;"></a>
                                    &nbsp;
                                    <a href="javascript:void(0);" onclick="deleteUserAction(<?php echo $user["id"];?>, '<?php echo $user["username"];?>')"><img src="./assets/images/icons/delete.png" style="width: 20px;"></a>
                                </td>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</div>

<div id="userModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create a new user</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="userManagementForm">
                    <div class="form-group">
                        <input type="hidden" class="form-control" placeholder="" name="userid">
                        <label>Username</label>
                        <input type="text" class="form-control" placeholder="Username" name="username">
                        <small class="form-text text-danger">Username cannot be changed after creation</small>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>First Name</label>
                            <input type="email" class="form-control" placeholder="First Name" name="firstname">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Last Name</label>
                            <input type="text" class="form-control" placeholder="Last Name" name="lastname">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Role</label>
                            <select class="form-control" name="role">
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Email</label>
                            <input type="text" class="form-control" placeholder="Email" name="email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" placeholder="Password" name="password">
                    </div>
                </form>


            </div>
            <div class="modal-footer">
                <button onclick="saveUserAction()" type="button" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>