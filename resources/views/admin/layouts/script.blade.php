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

    function formatAngka(x) {
        x = x.replace(/,/g, "");
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function showMessage(tipe, msg) {
        if (tipe == 'info') {
            $('#iconinfo').attr('class', 'info icon');
        } else if (tipe == 'error') {
            $('#iconinfo').attr('class', 'exclamation triangle icon');
        }
        $('#modalinfo').html(msg);
        $('#messagemodal').modal('show');
    }
</script>
