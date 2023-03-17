$.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(()=>{

    $('#createExpense').submit((e)=>{
        e.preventDefault()
        Swal.fire({
            title: 'Confirm action',
            text: "Do you want to create this expense ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, create expense!'
            }).then((result) => {
            if (result.isConfirmed) {
        
                try{
                    var formElement = document.getElementById('createExpense');
                var formData = new FormData(formElement);
                formData.append('reciept', $('#reciept').prop('files')[0], $('#reciept')[0].files[0].name);

                $.ajax({
                    type : "POST",
                    url : $('#createExpense').attr('action'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data){
                        Swal.fire(
                        'Success!',
                        'Expense has been succesfully created.',
                        'success'
                        ).then(()=>{
                            window.location.href = "/home"
                        })
                    },

                    error: ()=>{
                        Swal.fire(
                            'Oops!',
                            'We cannot complete this action now.. Kindly try again later or confirm you have filled every input with the correct information.',
                            'error'
                        )
                    }

                })
                }catch(error){
                    Swal.fire(
                        'Oops!',
                        'We cannot complete this action now.. Kindly try again later or confirm you have filled every input with the correct information.',
                        'error'
                    )
                }
                
            }
        })

    })

})


$('#merchantFilter').on('change',()=>{

    $('#clearFilter').removeClass('d-none').addClass('d-block')

    let val = $('#merchantFilter').val()

    $.ajax({
        type:"POST",
        url:"/filter",
        data: {merchant : val},
        success: (data)=>{

            $('#t-body').empty()

            $.each(data,(index,val)=>{

                var table = "<tr>"+
                "<td>"+val.date+"</td>"+
                "<td>"+val.merchant+"</td>"+
                "<td>"+val.total+"</td>"+
                "<td>"+val.status+"</td>"+
                "<td>"+val.comment+"</td>"+
                "</tr>"

                $('#t-body').append(table)
            })
        }
    })

})

$('#min').keyup(()=>{

    $('#clearFilter').removeClass('d-none').addClass('d-block')

    let val = $('#min').val()

    $.ajax({
        type:"POST",
        url:"/filterMin",
        data: {min : val},
        success: (data)=>{

            $('#t-body').empty()

            $.each(data,(index,val)=>{

                var table = "<tr>"+
                "<td>"+val.date+"</td>"+
                "<td>"+val.merchant+"</td>"+
                "<td>"+val.total+"</td>"+
                "<td>"+val.status+"</td>"+
                "<td>"+val.comment+"</td>"+
                "</tr>"

                $('#t-body').append(table)
            })
        }
    })
    
})

$('#max').keyup(()=>{

    $('#clearFilter').removeClass('d-none').addClass('d-block')

    let val = $('#max').val()

    $.ajax({
        type:"POST",
        url:"/filterMax",
        data: {max : val},
        success: (data)=>{

            $('#t-body').empty()

            $.each(data,(index,val)=>{

                var table = "<tr>"+
                "<td>"+val.date+"</td>"+
                "<td>"+val.merchant+"</td>"+
                "<td>"+val.total+"</td>"+
                "<td>"+val.status+"</td>"+
                "<td>"+val.comment+"</td>"+
                "</tr>"

                $('#t-body').append(table)
            })
        }
    })
    
})

$('#clearFilter').on('click',()=>{

    $('#min').val("")
    $('#max').val("")
    $('#clearFilter').removeClass('d-block').addClass('d-none')

    let val = "all"

    $.ajax({
        type:"POST",
        url:"/filter",
        data: {merchant : val},
        success: (data)=>{

            $('#t-body').empty()

            $.each(data,(index,val)=>{

                var table = "<tr>"+
                "<td>"+val.date+"</td>"+
                "<td>"+val.merchant+"</td>"+
                "<td>"+val.total+"</td>"+
                "<td>"+val.status+"</td>"+
                "<td>"+val.comment+"</td>"+
                "</tr>"

                $('#t-body').append(table)
            })
        }
    })

});


$('.openModal').on('click', ()=>{
    let val = $('.openModal').data('id')
    console.log(val)
})

