$(document).ready(function () {
    let table = $('#user_product_table');
    /*console.log(table);*/
    document.dataTable = table.DataTable({
        dom: 'Bfrtp',
        processing: false,
        serverSide: true,
        responsive: true,
        "bDestroy": true,
        "order": [],
        ajax: {
            url: base_url + '/product_list',
            type: 'post'
        },
        columns: [{
                data: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            {
                data: 'photo',
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'price',
                name: 'price'
            },
            {
                data: 'actions',
                orderable: false,
                searchable: false
            },
        ]
    });

    table.on('click', '.delete-link', function (e) {
        e.preventDefault();
        let link = this;

        swal({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((result) => {
                if (result) {
                    $.ajax({
                        url: link.href,
                        type: 'delete',
                        dataType: 'json',
                        success: function (response) {
                            if (response.success) {
                                $.notify(response.message, {
                                    type: 'success'
                                });
                                document.dataTable.draw();
                            } else if (!response.success) {
                                $.notify(response.message, {
                                    type: 'danger'
                                });
                            } else {
                                $.notify('Something went wrong', {
                                    type: 'danger'
                                });
                            }
                        },
                        error: function (response) {
                            let errors = response.responseJSON.errors;

                            if (errors) {
                                $.notify(Object.values(errors)[0], {
                                    type: 'danger'
                                });
                            }
                        }
                    })
                }
            });

    });


});
