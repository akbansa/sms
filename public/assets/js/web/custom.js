$(function () {

    var tab = $("#tab").val();
    if(tab=='register'){
        $("#loginTab").removeClass('active');
        $("#login").removeClass('in active');
        $("#forgotTab").removeClass('active');
        $("#forgot").removeClass('in active');
        $("#registerTab").addClass('active');
        $("#register").addClass('in active');
    }
    else if(tab=='forgot'){
        $("#loginTab").removeClass('active');
        $("#login").removeClass('in active');
        $("#registerTab").removeClass('active');
        $("#register").removeClass('in active');
        $("#forgotTab").addClass('active');
        $("#forgot").addClass('in active');
    }
    $("form[name=deleteForm]").submit(function () {
        event.preventDefault();
        var form = $(this).serialize();
        var url = $(this).attr("action");
        var deleteConfirm = confirm("Are you sure?");
        if(deleteConfirm) {
            $.ajax({
                url : url,
                method : "DELETE",
                data : form
            }).done(function (response) {
                /*alert("Record has been deleted successfully!");*/
                location.reload();
            }).fail(function () {
                alert("Record cannot be delete!");
            });
        }
    });
});
