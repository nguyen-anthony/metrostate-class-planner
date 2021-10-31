$(function () {
    $('#userUpdateForm').submit(function (e) {
        $.post('/wip/admin/adminqueries.php', {
            userId: $('#userID').val(),
            firstName: $('#firstNameField').val(),
            lastName: $('#lastNameField').val(),
            studentID: $('#studentIDField').val(),
            email: $('#emailField').val(),
            role: $('#roleSelection').val()
        }).done(function (data) {
            successNotify();
            document.getElementById("emailField").disabled = true;
            document.getElementById("firstNameField").disabled = true;
            document.getElementById("lastNameField").disabled = true;
            document.getElementById("studentIDField").disabled = true;
            document.getElementById("roleSelection").disabled = true;
            document.getElementById("updateAccountBtn").style.display = "none";
            document.getElementById("deleteButton").style.display = "none";
        });

        e.preventDefault();
        e.stopPropagation();
        setTimeout(function () {
            $(location).attr('href', '/wip/admin/admin.php');
        }, 5000)
        return false;
    });
});

function successNotify() {
    document.getElementById("notifications").style.display = "block";
    document.getElementById("notifications").innerHTML = "Successfully Updated! Sending you back to the admin page";
    setTimeout(function () {
        document.getElementById("notifications").style.display = "none";
        document.getElementById("notifications").innerHTML = "";
    }, 5000)
}

$(function () {
    $("#editButton").click(function () {
        $("#userTable input[type=checkbox]:checked").each(function () {
            var row = $(this).closest("tr")[0];
            $(location).attr('href', '/wip/admin/adminUpdate.php?ID=' + row.cells[1].innerHTML);
        });
    });
});

$(function () {
    $("#editAdvisorButton").click(function () {
        $("#advisorTable input[type=checkbox]:checked").each(function () {
            var row = $(this).closest("tr")[0];
            $(location).attr('href', '/wip/admin/adminUpdate.php?ID=' + row.cells[1].innerHTML);
        });
    });
});

$(function () {
    $("#deleteButton").click(function (e) {
        $.post('/wip/admin/adminDelete.php', {
            userId: $('#userID').val(),
        }).done(function (data) {
            successDelete();
            document.getElementById("emailField").disabled = true;
            document.getElementById("firstNameField").disabled = true;
            document.getElementById("lastNameField").disabled = true;
            document.getElementById("studentIDField").disabled = true;
            document.getElementById("roleSelection").disabled = true;
            document.getElementById("updateAccountBtn").style.display = "none";
            document.getElementById("deleteButton").style.display = "none";
        });

        e.preventDefault();
        e.stopPropagation()
        setTimeout(function () {
            $(location).attr('href', '/wip/admin/admin.php');
        }, 5000)
        return false;
    });
});

function successDelete() {
    document.getElementById("notifications").style.display = "block";
    document.getElementById("notifications").innerHTML = "Successfully Deleted! Sending you back to the admin page";
    setTimeout(function () {
        document.getElementById("notifications").style.display = "none";
        document.getElementById("notifications").innerHTML = "";
    }, 5000)
}

function ckChange(ckType) {
    var ckName = document.getElementsByName(ckType.name);

    for (var i = 0; i < ckName.length; i++) {
        ckName[i].checked = false;
    }

    ckType.checked = true;

}

function ckChangeAdvisor(ckType) {
    var ckName = document.getElementsByName(ckType.name);

    for (var i = 0; i < ckName.length; i++) {
        ckName[i].checked = false;
    }

    ckType.checked = true;

}