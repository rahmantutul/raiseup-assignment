jQuery(function () {
    $("#submit").click(function () {
        $(".error").hide();
        var hasError = false;
        var currentVal = $("#current").val();
        var passwordVal = $("#new").val();
        var checkVal = $("#confirm").val();
        if (currentVal == "") {
            $("#current").after(
                '<span class="error" style="color:red">Enter your old password</span>'
            );
            hasError = true;
        } else if (passwordVal == "") {
            $("#new").after(
                '<span class="error" style="color:red">Please enter a password.</span>'
            );
            hasError = true;
        } else if (checkVal == "") {
            $("#confirm").after(
                '<span class="error" style="color:red">Please re-enter your password.</span>'
            );
            hasError = true;
        } else if (passwordVal != checkVal) {
            $("#confirm").after(
                '<span class="error" style="color:red">Passwords do not match.</span>'
            );
            hasError = true;
        }
        if (hasError == true) {
            return false;
        }
    });
    //   Confirmation Delete

    $(".confirmDelete").click(function () {
        var name = $(this).attr("name");
        if (confirm("Are you sure you want to delete this " + name + "?")) {
            return true;
        } else {
            return false;
        }
    });

    //   Update Admin Status
    $(document).on("click", ".updateAdminStatus", function () {
        // $(".updateCategoryStatus").click(function(){
        var status = $(this).children("i").attr("status");
        var admin_id = $(this).attr("admin_id");
        $.ajax({
            type: "post",
            url: "/admin/update-admin-status",
            data: { status: status, admin_id: admin_id },
            success: function (resp) {
                if (resp["status"] == 0) {
                    $("#admin-" + admin_id).html(
                        "<i class='mdi mdi-toggle-switch-off' status='Disabled'></i>"
                    );
                } else if (resp["status"] == 1) {
                    $("#admin-" + admin_id).html(
                        "<i class='mdi mdi-toggle-switch' status='Active'></i>"
                    );
                }
            },
            error: function () {
                alert("Error");
            },
        });
    });
    //   Update jobs Status
    $(document).on("click", ".updateJobStatus", function () {
        var status = $(this).children("i").attr("status");
        var job_id = $(this).attr("job_id");
        $.ajax({
            type: "post",
            url: "/admin/job/update-job-status",
            data: { status: status, job_id: job_id },
            success: function (resp) {
                if (resp["status"] == 0) {
                    $("#job-" + job_id).html(
                        "<i class='mdi mdi-toggle-switch-off' status='Disabled'></i>"
                    );
                } else if (resp["status"] == 1) {
                    $("#job-" + job_id).html(
                        "<i class='mdi mdi-toggle-switch' status='Active'></i>"
                    );
                }
            },
            error: function () {
                alert("Error");
            },
        });
    });
});
