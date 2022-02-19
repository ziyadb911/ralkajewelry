<script>
    $(document).ready(function() {
        $('.numberonly').keydown(
            function(e) {
                if ((e.which < 48 || e.which > 57) && e.which != 8 && e.which != 9) {
                    e.preventDefault();
                }
            }
        );
        $('.numberonly').keyup(function() {
            this.value = formatAngka(this.value);
        });
        $('.ui.accordion').accordion();
        // create sidebar and attach to menu open
        $('.ui.sidebar').sidebar('attach events', '.toc.item');
        $('.formsearch').submit(function() {
            $('.formsearch').find('input').each(function() {
                var input = $(this);
                if (!input.val()) {
                    input.prop('disabled', true);
                }
            });
        });
        $('.ui.dropdown:not(:required)').dropdown({
            selectOnKeyDown: true,
            forceSelection: false,
            clearable: true,
            fullTextSearch: true,
        });
        $('.ui.dropdown').dropdown({
            selectOnKeyDown: true,
            forceSelection: false,
            clearable: false,
            fullTextSearch: true,
        });
        $('.ui.dropdown.button.actionbutton').dropdown({
            action: 'hide'
        });

        @yield('jsready')

        @if (session()->has('msg'))
            showMessage("info","{{ session()->get('msg') }}");
        @endif
        @if (session()->has('err'))
            showMessage("error","{{ session()->get('err') }}");
        @endif
    });

    @yield('jsfunction')

    var ajaxPost = function(form) {
        var url = $(form).attr("action");
        var frm = $(form);
        if (frm.attr("enctype") == "multipart/form-data") {
            var formData = new FormData(form);
            return $.ajax({
                type: frm.attr('method'),
                url: frm.attr('action'),
                data: formData,
                processData: false,
                contentType: false,
                timeout: 60000,
                error: function(data, textStatus, errorThrown) {
                    var errmsg = "";
                    if (textStatus == 'timeout') {
                        errmsg = "Timeout saat mengirimkan data";
                    } else {
                        if (data.responseJSON.errors != null) {
                            if (data.responseJSON.errors.length > 0) {
                                var errors = data.responseJSON.errors;

                                $.each(errors, function(key, val) {
                                    errmsg += val[0] + '<br/>';
                                })
                            }
                        } else {
                            errmsg = data.responseJSON.message;
                        }
                    }

                    showMessage("error", errmsg);
                    console.log(data, textStatus, errorThrown);
                }
            });
        } else {
            return $.ajax({
                type: frm.attr('method'),
                url: frm.attr('action'),
                data: frm.serialize(),
                timeout: 60000,
                error: function(data, textStatus, errorThrown) {
                    var errmsg = "";
                    if (textStatus == 'timeout') {
                        errmsg = "Timeout saat mengirimkan data";
                    } else {
                        if (data.responseJSON.errors != null) {
                            var errors = data.responseJSON.errors;

                            $.each(errors, function(key, val) {
                                errmsg += val[0] + '<br/>';
                            })
                        } else {
                            errmsg = data.responseJSON.message;
                        }
                    }

                    showMessage("error", errmsg);
                    console.log(data, textStatus, errorThrown);
                }
            });
        }
    }

    function formatAngka(x) {
        x = x.replace(/,/g, "");
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function showMessage(tipe, msg, redirect = null) {
        if (tipe == 'info') {
            $('#iconinfo').attr('class', 'info icon');
        } else if (tipe == 'error') {
            $('#iconinfo').attr('class', 'exclamation triangle icon');
        }
        if (redirect != null) {
            $('#messagemodal').modal('setting', 'closable', false);
            $('#btnOkMessage').click(function() {
                window.location.href = redirect
            });
        } else {
            $('#messagemodal').modal('setting', 'closable', true);
        }
        $('#modalinfo').html(msg);
        $('#messagemodal').modal('show');
    }
</script>
