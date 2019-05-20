$(document).ready(function () {

    function displayObject(idButton, idForm1, idForm2) {
        $(idButton).click(function () {
            $(idForm1).css("display", "block");
            $(idForm2).css("display", "none");
            $("#resmess").empty();
        });
    }

    displayObject("#registrationButton", "#registration", "#authorization");
    displayObject("#authorizationButton", "#authorization", "#registration");

    function ajaxRequest(idform, path,resMessage = "#resmess") {

        $(idform).submit(function () {
            $.ajax({
                url: path,
                type: "POST",
                data: $(idform).serialize(),
                success: function (data) {
                    data = JSON.parse(data);
                    for (var id in data){
                        $(resMessage).html(data[id]);
                     }
                },
                error: function () {
                    $("#resmess").html("Произошла ошибка");
                }
            });
            event.preventDefault();
        });
    }

    ajaxRequest("#fromReg", "/php/addUser.php");
    ajaxRequest("#fromAut", "/php/ConfirmUser.php");
    ajaxRequest("#exitForm", "/php/logout.php");


    $("input").on('keydown', function (e) {
        return e.which !== 32;
    });
});
