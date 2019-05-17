$( document ).ready(function() {

    $("#registrationButton").click(function () {
        $("#registration").css("display","block");
        $("#authorization").css("display","none");

    });

    $("#authorizationButton").click(function () {
        $("#registration").css("display","none");
        $("#authorization").css("display","block");
    });


    $("#fromReg").submit(function () {
        $.ajax({
            url: "/php/addUser.php",
            type: "POST",
            data: $("#fromReg").serialize(),
            success: function (data) {

                $("#resmess").html(data);

            }
        });
        event.preventDefault();
    });


});