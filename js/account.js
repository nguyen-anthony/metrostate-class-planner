$(function () {
    $.get('/wip/forms/accountInfo.php/?id=1', function (data) {
        var result = JSON.parse(data);
        $('#firstNameField').val(result['FIRST_NAME']);
        $('#lastNameField').val(result['LAST_NAME']);
        $('#emailField').val(result['USERNAME']);
        $('#studentField').val(result['STUDENT_ID']);
    });
});

$(function () {
    $("#submitPwReset").click(function (e) {
        $.post('/wip/secure/passwordReset.php/', {
            userId: $('#userID').val(),
            oldPw: $('#oldPassword').val(),
            newPw: $('#newPassword').val(),
            confirmPw: $('#confirmPassword').val()
        }).done(function (data) {
            var pwResult = JSON.parse(data);
            if (pwResult == "success") {
                document.getElementById("notifications").style.display = "block";
                document.getElementById("notifications").innerHTML = "Successfully changed password!"
                setTimeout(function () {
                    document.getElementById("notifications").style.display = "none";
                    document.getElementById("notifications").innerHTML = "";
                }, 5000)
            }
            if (pwResult == "fail") {
                document.getElementById("notifications").style.display = "block";
                document.getElementById("notifications").innerHTML = "Failed. Either you typed your old password incorrectly, your passwords don't match, or you did not meet password requirements.";
                setTimeout(function () {
                    document.getElementById("notifications").style.display = "none";
                    document.getElementById("notifications").innerHTML = "";
                }, 5000)
            }
            e.preventDefault();
            e.stopPropagation();
            return false;
        });
    });
});
