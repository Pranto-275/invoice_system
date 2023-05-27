$('#click').click(function () {
    var name = $('#name').val();
    var email = $('#email').val();
    var password = $('#password').val();
    var confirm_password = $('#confirmpassword').val();

    if (name == '' || email == '' || password == ''|| confirm_password == '') {

        Swal.fire(
            'No Data Found?',
            'Please fill all data?',
            'question'
        )


    } else {
        $.ajax({
            method: "POST",
            url: "insert.php",
            data: {
                name: name,
                email: email,
                password: password,
                confirm_password:confirm_password,
            },
            success: function (data) {
                if (data == 'namefailed') {
                    Swal.fire(
                        'Invalid Name?',
                        'Please fill valid data',
                        'error'
                    )

                } else if (data == 'invalid_email') {

                    Swal.fire(
                        'Invalid Email?',
                        'Please fill valid email',
                        'error'
                    )

                } else if(data == 'password_not_match'){

                    Swal.fire(
                        'Password does not match!!',
                        'Password and Confirm Password Should same',
                        'error'
                    )
                }

                else if (data == 'Success'){

                    read();
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Your work has been saved',
                        showConfirmButton: false,
                        timer: 1500
                    })

                    $('#name').val('');
                    $('#email').val('');
                    $('#password').val('');
                    $('#confirm_password').val('');
                    read();

                }else{
                    read();
                }



            }
        });


    }

});

function read() {

    $.ajax({
        method: "POST",
        url: "view.php",
        success: function (data) {
            $('#tbody').html(data);

        }
    });
}


//delete


function deleteInfo(ID) {


    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
            )

            var id = ID;
            $.ajax({
                method: "POST",
                url: "delete.php",
                data: {
                    id: id
                },
                success: function (data) {
                    read();


                }
            })
        }
    })


}


//edit

function editInfo(ID) {
    var id = ID;

    $.ajax({
        method: "GET",
        url: "get_data.php",
        data: {
            id: id
        },
        success: function (data) {

            var userdata = JSON.parse(data);

            $('.header_id').html(userdata.id);
            $('#editname').val(userdata.name);
            $('#editemail').val(userdata.email);


        }

    });
}

//update

$('#editclick').click(function () {
    var id = $('.header_id').html();
    var name = $('#editname').val();
    var email = $('#editemail').val();
    var password = $('#editpassword').val();
    var cpassword = $('#editcpassword').val();

    if (name == '' || email === '' || password == '' || id == ''|| cpassword == '') {

        Swal.fire(
            'No Data Found?',
            'Please fill all data?',
            'question'
        )


    } else {

        $.ajax({
            method: "POST",
            url: "update.php",
            data: {
                id: id,
                name: name,
                email: email,
                password: password,
                cpassword:cpassword
            },
            success: function (data) {

                if (data == 'invalid_name') {
                    Swal.fire(
                        'Invalid Name?',
                        'Please fill valid data',
                        'error'
                    )

                } else if (data == 'invalid_email') {

                    Swal.fire(
                        'Invalid Email?',
                        'Please fill valid email',
                        'error'
                    )

                } else if(data == 'password_not_match'){

                    Swal.fire(
                        'Password does not match!!',
                        'Password and Confirm Password Should same',
                        'error'
                    )
                }

                else if (data == 'Success'){

                    read();
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Your work has been saved',
                        showConfirmButton: false,
                        timer: 1500
                    })

                    $('#editname').val('');
                    $('#editemail').val('');
                    $('#editpassword').val('');
                    $('#editcpassword').val('');
                    $('#exampleModal').modal('hide')
                    read();


                }else {
                    read();
                }



            }
        });
        ;
    }

});


//cbs


$('#export').click(function (){

    $.ajax({
        method: "POST",
        url:"export.php",
        success:function (data){
                alert(data);
        }
    })
});
