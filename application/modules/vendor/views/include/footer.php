
</div>
<footer class="main-footer">
    <div class="pull-right hidden-xs">Version 1.0</div> 
    Copyright © 2020 Zanomy.com.
</footer>
<script src="<?php echo site_url('assets/vendor/js/jquery.min.js'); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="<?php echo site_url('assets/vendor/js/bootstrap.min.js'); ?>"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.min.js"></script>
<script src="<?php echo site_url('assets/vendor/js/bizadmin.js'); ?>"></script>
<script src="<?php echo site_url('assets/vendor/plugins/jquery-sparklines/jquery.sparkline.min.js'); ?>"></script>
<script src="<?php echo site_url('assets/vendor/plugins/jquery-sparklines/sparkline-int.js'); ?>"></script>
<script src="<?php echo site_url('assets/vendor/plugins/raphael/raphael-min.js'); ?>"></script>
<script src="<?php echo site_url('assets/vendor/plugins/morris/morris.js'); ?>"></script>
<script src="<?php echo site_url('assets/vendor/plugins/functions/dashboard1.js'); ?>"></script>
<script src="<?php echo site_url('assets/vendor/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo site_url('assets/vendor/plugins/datatables/dataTables.bootstrap.min.js'); ?>"></script>
<script src="<?php echo site_url('assets/vendor/js/demo.js'); ?>"></script>
<script src="<?php echo site_url('assets/vendor/plugins/formwizard/jquery-steps.js'); ?>"></script>
<script src="<?php echo site_url('assets/vendor/plugins/dropify/dropify.min.js'); ?>"></script>
<script src="<?php echo site_url('assets/vendor/plugins/chartjs/chart.min.js'); ?>"></script>
<script src="<?php echo site_url('assets/vendor/plugins/chartjs/chart-int.js'); ?>"></script> 
<script type="text/javascript">

    $(".chosen").chosen();
</script>
<script type="text/javascript">
    var $loading = $('#loading').hide();
    $(document)
            .ajaxStart(function () {
                //ajax request went so show the loading image
                $loading.show();
            })
            .ajaxStop(function () {
                //got response so hide the loading image
                $loading.hide();

            });
    $(document).ready(function () {


        $('#example-getting-started').multiselect({
            numberDisplayed: 1,
            includeSelectAllOption: true,
            allSelectedText: 'All Topics selected',
            nonSelectedText: 'No Topics selected',
            selectAllValue: 'all',
            selectAllText: 'Select all',
            unselectAllText: 'Unselect all',
            onSelectAll: function (checked) {
                var all = $('#example-getting-started ~ .btn-group .dropdown-menu .multiselect-all .checkbox');
                all
                        // get all child nodes including text and comment
                        .contents()
                        // iterate and filter out elements
                        .filter(function () {
                            // check node is text and non-empty
                            return this.nodeType === 3 && this.textContent.trim().length;
                            // replace it with new text
                        }).replaceWith(checked ? this.unselectAllText : this.selectAllText);
            },
            onChange: function () {
                debugger;
                var select = $(this.$select[0]);
                var dropdown = $(this.$ul[0]);
                var options = select.find('option').length;
                var selected = select.find('option:selected').length;
                var all = dropdown.find('.multiselect-all .checkbox');
                all
                        // get all child nodes including text and comment
                        .contents()
                        // iterate and filter out elements
                        .filter(function () {
                            // check node is text and non-empty
                            return this.nodeType === 3 && this.textContent.trim().length;
                            // replace it with new text
                        }).replaceWith(options === selected ? this.options.unselectAllText : this.options.selectAllText);
            }
        });

        $("#form").submit(function (e) {
            e.preventDefault();
            alert($(this).serialize());
        });

    });


</script>
<script>
    $(function () {
        $('#example1').DataTable()
        $('#example2').DataTable()
        $('#example3').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false
        });

    })
</script>
<script>
    $(document).ready(function () {
        var filter = (<?= isset($_POST['filterBtn']) ? 1 : 0 ?>);
        $('#example4').DataTable({
            "language": {
                "emptyTable": (filter ? "No match found <a href='product-list'>view all products</a>" : "No data available in the table")
            }
        });
    });

</script>
<script>
    var frmRes = $('#frmRes');
    var frmResValidator = frmRes.validate();

    var frmInfo = $('#frmInfo');
    var frmInfoValidator = frmInfo.validate();

    var frmLogin = $('#frmLogin');
    var frmLoginValidator = frmLogin.validate();

    var frmMobile = $('#frmMobile');
    var frmMobileValidator = frmMobile.validate();

    $('#demo1').steps({
        onChange: function (currentIndex, newIndex, stepDirection) {
            console.log('onChange', currentIndex, newIndex, stepDirection);
            // tab1
            if (currentIndex === 0) {
                if (stepDirection === 'forward') {
                    var valid = frmRes.valid();
                    return valid;
                }
                if (stepDirection === 'backward') {
                    frmResValidator.resetForm();
                }
            }

            // tab2
            if (currentIndex === 1) {
                if (stepDirection === 'forward') {
                    var valid = frmInfo.valid();
                    return valid;
                }
                if (stepDirection === 'backward') {
                    frmInfoValidator.resetForm();
                }
            }

            // tab3
            if (currentIndex === 2) {
                if (stepDirection === 'forward') {
                    var valid = frmLogin.valid();
                    return valid;
                }
                if (stepDirection === 'backward') {
                    frmLoginValidator.resetForm();
                }
            }

            // tab4
            if (currentIndex === 3) {
                if (stepDirection === 'forward') {
                    var valid = frmMobile.valid();
                    return valid;
                }
                if (stepDirection === 'backward') {
                    frmMobileValidator.resetForm();
                }
            }

            return true;

        },
        onFinish: function () {
            alert('Wizard Completed');
        }
    });
</script> 
<script>
    $('#demo').steps({
        onFinish: function () {
            alert('Wizard Completed');
        }
    });
</script>
<script>
    $(document).ready(function () {
        // Basic
        $('.dropify').dropify();

        // Translated
        $('.dropify-fr').dropify({
            messages: {
                default: 'Glissez-déposez un fichier ici ou cliquez',
                replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                remove: 'Supprimer',
                error: 'Désolé, le fichier trop volumineux'
            }
        });

        // Used events
        var drEvent = $('#input-file-events').dropify();

        drEvent.on('dropify.beforeClear', function (event, element) {
            return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
        });

        drEvent.on('dropify.afterClear', function (event, element) {
            alert('File deleted');
        });

        drEvent.on('dropify.errors', function (event, element) {
            console.log('Has Errors');
        });

        var drDestroy = $('#input-file-to-destroy').dropify();
        drDestroy = drDestroy.data('dropify')
        $('#toggleDropify').on('click', function (e) {
            e.preventDefault();
            if (drDestroy.isDropified()) {
                drDestroy.destroy();
            } else {
                drDestroy.init();
            }
        })
    });

    $('.numberOnly').keypress(function (e) {
        var regex = new RegExp(/^[0-9]+$/);
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (regex.test(str)) {
            return true;
        } else {
            e.preventDefault();
            return false;
        }
    });

    $('.discount').keyup(function (e) {
        var discount = $(this).val();
        if (discount < 0 || discount > 100) {
            e.preventDefault();
             $(".errorPrint").css('display', 'block');
            $('#discountError').html('invalid discount percentage');
            $('#add_product_set').attr('disabled', true);
            return false;
        } else {
             $(".errorPrint").css('display', 'none');
            $('#add_product_set').attr('disabled', false);
            $('#discountError').html('');
            return true;
        }
    });
</script>
</body>

</html>
