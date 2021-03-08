$(document).ready(function (){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            let reader = new FileReader();

            reader.onload = function (e) {
                $('.profile-img-tag').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#profile-img").change(function(){
        readURL(this);
    });

    $("select[name='province']").change(function(){
        let id = $(this).find(':selected').data('id');

        $.ajax({
            url: `/districts/${id}`,
            method: 'get',
            success: function(districts) {
                if (districts.code === 200) {
                    $("select[name='district']").html('');
                    $.each(districts.data, function(key, value){
                        $("select[name='district']").append(
                            `<option data-id="${value.id}" value="${value.name}">${value.name}</option>`
                        );
                    });
                }
            }
        });
    })

    $("select[name='district']").change(function(){
        let id = $(this).find(':selected').data('id');

        $.ajax({
            url: `/wards/${id}`,
            method: 'get',
            success: function(wards) {
                if (wards.code === 200) {
                    $("select[name='ward']").html('');
                    $.each(wards.data, function(key, value){
                        $("select[name='ward']").append(
                            `<option data-id="${value.id}" value="${value.name}">${value.name}</option>`
                        );
                    });
                }
            }
        });
    })
});
