

$(document).ready( function () {
    $('#table').DataTable();
} );

function deleteUserAction(id, username){
    if(id){
        var c = confirm("Are you sure you want to delete this user - " + username);
        if(c){
            // take action here
        }
    }
}

function saveUserAction(){

}

function editUserAction(id, username){
    var newUser = false;
    if(id == null){
        newUser = true;
        clearUserFormFields('userManagementForm');
        showModal("Create a new User");
    }else{
        $.get("ajax/getUser.php",{id: id, username: username}, function(response){
            var rObject = getJsonResponseObject(response);
            if(rObject.status == "good"){
                $('#userManagementForm input[name="username"]').val(rObject.data.username);
                $('#userManagementForm input[name="firstname"]').val(rObject.data.firstname);
                $('#userManagementForm input[name="lastname"]').val(rObject.data.lastname);
                $('#userManagementForm input[name="email"]').val(rObject.data.email);
                $('#userManagementForm input[name="role"]').val(rObject.data.role);
                $('#userManagementForm input[name="userid"]').val(rObject.data.userid);
                console.log(rObject.data);
                showModal("Edit this user");
            }
        });
    }
}

function showModal(title){
    $('#userModal .modal-title').text(title);
    $("#userModal").modal("show");
}

function clearUserFormFields(id){
    console.log("clearing fields");
    $('#'+id)[0].reset();
}