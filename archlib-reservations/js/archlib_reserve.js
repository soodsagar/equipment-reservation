$(function() {

    $('#side-menu').metisMenu();
    
//Loads the correct sidebar on window load
    $(function() {

        $(window).bind("load", function() {
            console.log($(this).width())
            if ($(this).width() < 753) {
                $('div.sidebar-collapse').addClass('collapse')
            } else {
                $('div.sidebar-collapse').removeClass('collapse')
            }
        });
    });

//Collapses the sidebar on window resize
    $(function() {

        $(window).bind("resize", function() {
            console.log($(this).width())
            if ($(this).width() < 753) {
                $('div.sidebar-collapse').addClass('collapse')
            } else {
                $('div.sidebar-collapse').removeClass('collapse')
            }
        });
    });
});




/*
$(document).ready(function(){
    $(".fc-day").on("click", function(){
        var date = $(this).attr('data-date');
        var url = "choose.php?date="+date;
        location.href=url;

    });
});


*/





// ================== FULL CALENDER INIT ========================


$(document).ready(function() {


    $("#calendar").fullCalendar({
        maxEvents: 2,

        header: {
            left: 'title',
            right: 'prev,next, today'
        },


        eventLimit: true,

        events: {
            url: 'js/ajax/get_events.php',
            type: 'POST',
            error: function(xhr, response) {
                alert('There was an error while fetching events.'+xhr+response);
            }
        },

        aspectRatio: 1.8,


        dayClick: function(date){
            date = moment(date).format("YYYY-MM-DD");
            location.href="form.php?date="+date;
        }

    });



// ====  EQUIPMENT MANAGEMENT PAGE  ==== //

    // Add New Eqp.
    $("#saveAddEqp").click(function(){
        var eqpName = $("#AddNewEqpName").val();
        var status = $("input[name='AddNewStatus']:checked").val();
        if (status == "active"){status = "Y"; }
        else {status = "N";}
        $.ajax({
            url: "js/ajax/eqpmgmt.php",
            data: {action: "add", name: eqpName, status: status},
            method: "post",
            success: function(result){
                if (result == "duplicate"){
                    alert("Equipment name already exists. Please choose another name. ");
                }
                else{
                    alert("New equipment added successfully!");
                    location.reload();
                }
            },
            error: function(xhr, status, response){
                alert("There was an error <br>Response: "+response+"<br>"+status);
            }
        });
    });

    // Edit Eqp.
    $(".saveEditEqp").click(function(){
        var eqpid = $(this).attr("data-id");

        var eqpName = $("#EditEqpName"+eqpid).val();
        var status = $("input[name='editStatus"+eqpid+"']:checked").val();
        if (status == "active"){status = "Y"; }
        else {status = "N";}


        $.ajax({
            url: "js/ajax/eqpmgmt.php",
            data: {action: "edit", name: eqpName, status: status, id: eqpid},
            method: "post",
            success: function(result){
                if (result == "duplicate"){
                    alert("Equipment name already exists. Please choose another name. ");
                }
                else{
                    alert("Equipment information edited successfully!");
                    location.reload();
                }
            },
            error: function(xhr, status, response){
                alert("There was an error <br>Response: "+response+"<br>"+status);
            }
        });
    });


    // Delete Eqp.
    $(".delete-eqp").click(function(){
        var eqpid = $(this).attr("data-id");

        alertify.confirm("Are you sure you would like this delete this equipment?", function(e){
            if (e){
                $.ajax({
                    url: "js/ajax/eqpmgmt.php",
                    data: {action: "delete", id: eqpid},
                    method: "post",
                    success: function(result){
                        alertify.alert("Equipment deleted successfully!");
                        location.reload();
                    },
                    error: function(xhr, status, response){
                        alertify.alert("There was an error <br>Response: "+response+"<br>"+status);
                    }
                });
            }
            else{
                return false;
            }
        });


    });



});



// ===============================================================



// ================== SLOT CHECK FORM ==========================


$(function(){
    $("#cboslot").change(function(){
        var slotcd = this.value;
        var date = $(".date-needed").val();

            $.ajax({
                url: "js/ajax/check_eqp_avail.php",
                method : "post",
                data: {slotcd: slotcd, date: date},
                success: function(result){
                    var json_data = $.parseJSON(result);
                    console.log(result);
                    $.each(json_data, function(key, value){
                        var keys = key.split("~");

                    console.log(result);
                        var tag = ".avail-"+keys[1];
                        if (value=="0"){
                            $(tag).hide().html("<span class='label label-success'> <i class='fa fa-check-circle'></i> Available </span>").fadeIn('slow');
                            var $cbox = $("#eqp-" + keys[1]);
                            $cbox.prop("disabled", false);
                        }
                        else if(value=="1"){
                            $(tag).hide().html("<span class='label label-danger'> <i class='fa fa-check-ban'></i> Not Available </span>").fadeIn('slow');
                            var $cbox = $("#eqp-" + keys[1]);
                            $cbox.prop("disabled", true);

                        }

                    });
                },
                error: function(xhr, status, response){
                    alert("There was an error --> "+status+"<br>  Response: "+response);
                }
            });

    });
});



//=============== RECURSIVE REQUEST =================

$("#recurRadio").change(function(){
    var option = $(this).val();

    if (option == "every_week"){
        var startDate = $(".startdate").value;
        var endDate = $(".endDateRecur").value;

        console.log(startDate+"  "+endDate);
    }
});























