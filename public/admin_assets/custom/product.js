$(document).ready(function () {
    let table = $('#product_table');
    /*console.log(table);*/
    document.dataTable = table.DataTable({
        dom: 'Bfrtp',
        processing: false,
        serverSide: true,
        responsive: true,
        "bDestroy": true,
        "order": [],
        ajax: {
            url: base_url + '/admin/product_list',
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

    $("form[name='add_product_form']").on('submit', function (e) {
        e.preventDefault();
    }).validate({
        rules: {
            "name": {
                required: true,
            },
            "price": {
                required: true,
            },
            "photo": {
                required: true,
                extension: "jpg|jpeg|png"
            },
            "description": {
                required: true,
            }
        },
        messages: {
            "name": {
                required: "Please enter Product name",
            },
            "price": {
                required: "Please select Product Price",
            },
            "photo": {
                required: "Please select Product Photo",
                extension: "File not supported Valid image - jpg, jpeg, png"
            },
            "description": {
                required: "Please enter product details",
            }
        },
        submitHandler: function (form) {
            var formData = new FormData(form);
            $("#add_product_form button[type='submit']").attr('disabled', true);
            $.ajax({
                url: $(form).attr("action"),
                type: 'post',
                data: formData,
                processData: false,
                cache: false,
                contentType: false,
                success: function (response) {
                    if (response.success) {
                        $.notify(response.message, {
                            type: 'success'
                        });
                        window.location.href = base_url + '/admin/product';
                    } else if (!response.success) {
                        $.notify(response.message, {
                            type: 'danger'
                        });
                    } else {
                        $.notify('Something went wrong', {
                            type: 'danger'
                        });
                    }
                }
            });
            $("#add_product_form button[type='submit']").attr('disabled', false);
        }
    });

    $("form[name='update_product_form']").on('submit', function (e) {
        e.preventDefault();
    }).validate({
        rules: {
            "name": {
                required: true,
            },
            "price": {
                required: true,
            },
            "photo": {
                extension: "jpg|jpeg|png"
            },
            "description": {
                required: true,
            }
        },
        messages: {
            "name": {
                required: "Please enter Product name",
            },
            "price": {
                required: "Please select Product Price",
            },
            "photo": {
                extension: "File not supported Valid image - jpg, jpeg, png"
            },
            "description": {
                required: "Please enter product details",
            }
        },
        submitHandler: function (form) {
            var formData = new FormData(form);
            $("#update_product_form button[type='submit']").attr('disabled', true);
            $.ajax({
                url: $(form).attr("action"),
                type: 'post',
                data: formData,
                processData: false,
                cache: false,
                contentType: false,
                success: function (response) {
                    if (response.success) {
                        $.notify(response.message, {
                            type: 'success'
                        });
                        window.location.href = base_url + '/admin/product';
                    } else if (!response.success) {
                        $.notify(response.message, {
                            type: 'danger'
                        });
                    } else {
                        $.notify('Something went wrong', {
                            type: 'danger'
                        });
                    }
                }
            });
            $("#update_product_form button[type='submit']").attr('disabled', false);
        }
    });


});
