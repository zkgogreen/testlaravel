<script>
    $(function() {

        var appendthis = ("<div class='modal-overlay js-modal-close'></div>");

        $('a[data-modal-id]').click(function(e) {
            e.preventDefault();
            $("body").append(appendthis);
            $("#featureModal3").val(null).trigger("change");
            $(".modal-overlay").fadeTo(500, 1);
            //$(".js-modalbox").fadeIn(500);
            var modalBox = $(this).attr('data-modal-id');
            $('#' + modalBox).fadeIn($(this).data());
        });


        $(".js-modal-close, .modal-overlay").click(function() {
            $(".modal-box, .modal-overlay").fadeOut(500, function() {
                $(".modal-overlay").remove();
            });

        });

        $(".js-modal-close, .modal-overlay").click(function() {
            $(".modal-box2, .modal-overlay").fadeOut(500, function() {
                $(".modal-overlay").remove();
            });

        });

        $(".js-modal-close, .modal-overlay").click(function() {
            $(".modal-box3, .modal-overlay").fadeOut(500, function() {
                $(".modal-overlay").remove();
            });

        });

        $(window).resize(function() {
            $(".modal-box").css({
                top: ($(window).height() - $(".modal-box").outerHeight()) / 2,
                left: ($(window).width() - $(".modal-box").outerWidth()) / 2
            });
        });

        $(window).resize(function() {
            $(".modal-box2").css({
                top: ($(window).height() - $(".modal-box2").outerHeight()) / 2,
                left: ($(window).width() - $(".modal-box2").outerWidth()) / 2
            });
        });
        $(window).resize(function() {
            $(".modal-box3").css({
                top: ($(window).height() - $(".modal-box3").outerHeight()) / 2,
                left: ($(window).width() - $(".modal-box3").outerWidth()) / 2
            });
        });
        $(window).resize(function() {
            $(".modal-box5").css({
                top: ($(window).height() - $(".modal-box5").outerHeight()) / 2,
                left: ($(window).width() - $(".modal-box5").outerWidth()) / 2
            });
        });

        $(window).resize();

    });
</script>

<!-- container-scroller -->
<!-- plugins:js -->

<!--     <script src="vendors/responsive-bs-tabs-dropdown/dist/js/responsive-tabs.js"></script> -->
<!-- End custom js for this page-->
<script>
    // (function($) {
    //     $('.nav-tabs').responsiveTabs();
    // })(jQuery);
    $('#modal').on('hidden.bs.modal', function() {
        $(this).removeData('bs.modal');
    });

    function deleteConfirm(url) {
        $('#btn-delete').attr('href', url);
        $('#deleteModal').modal();
    }
</script>
<script type="text/javascript">
    $(function() {
        $('#tableData').bootstrapTable()
    })
</script>
<script>
    $(document).ready(function() {
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 4000);
    });
</script>

<script type=text/javascript>
    // $('#_provinsi').change(function() {
    //     var ProvName = $(this).val();
    //     if (ProvName) {
    //         $.ajax({
    //             type: "GET",
    //             url: "{{ url('getKabkot') }}?provinsi=" + provName,
    //             success: function(res) {
    //                 if (res) {
    //                     $("#_kabkot").empty();
    //                     $("#_kabkot").append(
    //                         '<option value="piilhkabkot" selected>-- Pilih Semua Kab/Kota --</option>'
    //                     );
    //                     $.each(res, function(key, value) {
    //                         $("#_kabkot").append('<option value="' + key + '">' + value +
    //                             '</option>');
    //                     });

    //                 } else {
    //                     $("#_kabkot").empty();
    //                 }
    //             }
    //         });
    //     } else {
    //         $("#_kabkot").empty();
    //         $("#_kecamatan").empty();
    //     }
    // });
    // $('#_kabkot').on('change', function() {
    //     var KabkotName = $(this).val();
    //     if (KabkotName) {
    //         $.ajax({
    //             type: "GET",
    //             url: "{{ url('getKec') }}?kabkot=" + KabkotName,
    //             success: function(res) {
    //                 if (res) {
    //                     $("#_kecamatan").empty();
    //                     $("#_kecamatan").append(
    //                         '<option value="piilhkecamatan">-- Pilih Semua Kecamatan --</option>'
    //                     );
    //                     $.each(res, function(key, value) {
    //                         $("#_kecamatan").append('<option value="' + key + '">' + value +
    //                             '</option>');
    //                     });

    //                 } else {
    //                     $("#_kecamatan").empty();
    //                 }
    //             }
    //         });
    //     } else {
    //         $("#_kecamatan").empty();
    //     }

    // });

    $('#sProvinsi').on('change', function() {
        $.post('{{ URL::to('/dropdown') }}', {
            type: 'kabupaten',
            id: $('#sProvinsi').val()
        }, function(e) {
            $('#sKabupaten').html(e);
        });
        $('#sKecamatan').html('');
        $('#sKelurahan').html('');
    });
    $('#sKabupaten').on('change', function() {
        $.post('{{ URL::to('/dropdown') }}', {
            type: 'kecamatan',
            id: $('#sKabupaten').val()
        }, function(e) {
            $('#sKecamatan').html(e);
        });
        $('#sKelurahan').html('');
    });
    $('#sKecamatan').on('change', function() {
        $.post('{{ URL::to('/dropdown') }}', {
            type: 'kelurahan',
            id: $('#sKecamatan').val()
        }, function(e) {
            $('#sKelurahan').html(e);
        });
    });
</script>
