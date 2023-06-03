
</div>
<footer class="main-footer">
    <div class="pull-right hidden-xs">Version 1.0</div> 
    Copyright © 2020 Zanomy.com.
</footer>


<script src="<?php echo site_url('assets/admin/js/jquery.min.js'); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="<?php echo site_url('assets/admin/js/bootstrap.min.js'); ?>"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.min.js"></script>
<script src="<?php echo site_url('assets/admin/js/bizadmin.js'); ?>"></script>
<script src="<?php echo site_url('assets/admin/plugins/jquery-sparklines/jquery.sparkline.min.js'); ?>"></script>
<script src="<?php echo site_url('assets/admin/plugins/jquery-sparklines/sparkline-int.js'); ?>"></script>
<script src="<?php echo site_url('assets/admin/plugins/raphael/raphael-min.js'); ?>"></script>
<script src="<?php echo site_url('assets/admin/plugins/morris/morris.js'); ?>"></script>
<script src="<?php echo site_url('assets/admin/plugins/functions/dashboard1.js'); ?>"></script>
<script src="<?php echo site_url('assets/admin/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo site_url('assets/admin/plugins/datatables/dataTables.bootstrap.min.js'); ?>"></script>
<script src="<?php echo site_url('assets/admin/js/demo.js'); ?>"></script>
<script src="<?php echo site_url('assets/admin/plugins/formwizard/jquery-steps.js'); ?>"></script>
<script src="<?php echo site_url('assets/admin/plugins/dropify/dropify.min.js'); ?>"></script>
<script src="<?php echo site_url('assets/admin/plugins/chartjs/chart.min.js'); ?>"></script>
<script src="<?php echo site_url('assets/admin/plugins/chartjs/chart-int.js'); ?>"></script> 
<script>
    $(".chosen").chosen();

    $(document).ready(function () {
        $(document)
        .ajaxStart(function () {
            $('.ajax-loader').css("visibility", "visible");
        })
        .ajaxStop(function () {
            $('.ajax-loader').css("visibility", "hidden");
        });
    });

</script>
<script type="text/javascript">
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
        })
    })
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

        showPrivilegeTabsOnly();
    });
</script>


<script>
    function showPrivilegeTabsOnly() {
        $('#sidebarUl li.dashboard').css('display', 'block');
        $.ajax({
            url: "<?= base_url() ?>admin/Access/getPrivilege",
            type: "post",
            success: function (data) {
                var dt = $.trim(data);
                var jsonData = $.parseJSON(dt);
                $.each(jsonData['data'], function (i, row) {
                    var getAnchor = $('#sidebarUl').find('a[href="<?= base_url() ?>admin/' + row['sub_menu_title'] + '"]');
                    var mainLi = $(getAnchor).closest('.treeview');
                    var parentLi = $(getAnchor).parent('li');
                    $(parentLi).css('display', 'block');
                    $(mainLi).css('display', 'block');
                });
            }
        });
    }
    

    function checkNumbersOnly(obj) {
        var regex2 = new RegExp(/^[0-9]+([.])+[0-9]+$/);
        var regex = new RegExp(/^[0-9]+$/);
        var flag = 0;
        var number = 0;
        var discount = $(obj).val();
        if (regex2.test(discount)) {
            flag = 1;
        } else {
            if (regex.test(discount)) {
                flag = 1;
            } else {
                flag = 0;
            }
        }
        if (flag) {
            if (discount != "" && discount >= 0 && discount <= 100) {
                number = 1;
            } else {
                number = 0;
            }
        } else {
            $('#percentageError').html('* not a valid number. percentage should be between 0 - 100 number only');
            $('#add_product_set').attr('disabled',true);
            return false;
        }
        if (number) {
            $('#percentageError').html('');
            $('#add_product_set').attr('disabled',false);
            return true;
        } else {
            $('#percentageError').html('* percentage should be between 0 - 100 only');
            $('#add_product_set').attr('disabled',true);
            return false;
        }
    }

</script>
</body>
</html>