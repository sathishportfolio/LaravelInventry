$( document ).ready(function() {

    $('.change_supplier_name').on('change',function(){

        if($(this).find(':selected').val() == 0){
            $('.supplier_name').val('');
        }
        else{
            $('.supplier_name').val($(this).find(':selected').text());    
        }
        
         
    });

    $('.inline_report_type').on('change',function(){
        $('.generate_report_inline').submit();
         
    });

    $('.inline_datepicker_from,.inline_datepicker_to').datepicker({
        onSelect: function(date) {
            $('.generate_report_inline').submit();
        }
    });

    $('.measures_check').on('click',function(){
        
        sub_div = '.measure_id_'+$(this).val();
        sub_input = '.measure_unit_'+$(this).val();

        if($(this).is(':checked')){
            $(sub_div).show();
            $(sub_input).removeAttr('disabled');    
        }else{
            $(sub_div).hide();
            $(sub_input).attr('disabled','disabled').prop('disabled',true);    
        }
        
    });

    $('.stock_id').on('change',function(){
        $('.search_purchase_cost').val($(this).find(':selected').attr('purchase_cost'));
        $('.search_selling_cost').val($(this).find(':selected').attr('selling_cost'));
        $('.search_stock_quantity').val($(this).find(':selected').attr('opening_stock'));

        $('.change_sales_quantity').attr('max',$(this).find(':selected').attr('opening_stock'));

        var e = $.Event('keyup'); $('.change_purchase_quantity').trigger(e);
    });

    $(function () {

        $(".from,.to").keypress(function(event) {event.preventDefault();});

        $('.from').datepicker({
            onSelect: function(date) {

                $(".to").datepicker("option", "minDate", new Date($('.from').val()) ).val('');

                $('.generate_report').bootstrapValidator('revalidateField', 'from');
                $('.generate_report').bootstrapValidator('revalidateField', 'to');
            },
            format: 'MM/DD/YYYY',
            useCurrent: true,
            changeMonth: true,
            changeYear: true
        });

        $('.to').datepicker({
            onSelect: function(date) {
                $('.generate_report').bootstrapValidator('revalidateField', 'from');
                $('.generate_report').bootstrapValidator('revalidateField', 'to');
            },
            format: 'MM/DD/YYYY',
            useCurrent: true,
            changeMonth: true,
            changeYear: true
        });


    $(".inline_datepicker_to").datepicker("option", "minDate", new Date($('.inline_datepicker_from').val()) );
    $(".inline_datepicker_from").datepicker("option", "maxDate", new Date($('.inline_datepicker_to').val()) );

        
    });

    $( ".search_category_name" ).autocomplete({
      source: "/search/category_name",
      minLength: 1,
      response: function(event, ui) {
            if (ui.content.length === 0) {

                $(this).parent().addClass('has-error');
                $(this).next().removeClass('glyphicon-ok').addClass('glyphicon-remove');
                $(".search_category_name_empty").show();
                $('.form_submit').hide();

            } else {
                $(".search_category_name_empty").hide();
                $('.form_submit').show();
            }
        },
      select: function(event, ui) {

        $('.search_category_id').val(ui.item.id);

        $('.unit_of_measure_container').empty();

        $('.measuring_units').val('');

        $.each( ui.item.units , function( key, value ) {

            if($('.measuring_units').val() == ''){
                $('.measuring_units').val(value.measures.name);
            }else{
                $('.measuring_units').val($('.measuring_units').val()+ ' x ' +value.measures.name);    
            }
            

            $('.unit_of_measure_container').append('<div class="col-sm-6"><div class="form-group"><label>'+value.measures.name+' ( in '+value.uom.name+' )</label><input type="hidden" name="measure_id[]" value='+value.measures.measure_id+'><input type="hidden" name="uom_id[]" value='+value.uom.uom_id+'> <input type="number" min="0" class="form-control" name="value[]" autocomplete="off"> </div></div>');
        });

      }
    });

    $( ".search_purchase_category_name" ).autocomplete({
      source: "/search/purchase_category_name",
      minLength: 1,
      response: function(event, ui) {
            if (ui.content.length === 0) {

                $(this).parent().addClass('has-error');
                $(this).next().removeClass('glyphicon-ok').addClass('glyphicon-remove');
                $(".search_purchase_category_name_empty").show();
                $('.form_submit').hide();

            } else {
                $(".search_purchase_category_name_empty").hide();
                $('.form_submit').show();
            }
        },
      select: function(event, ui) {

        $('.search_category_id').val(ui.item.id);

        $('.unit_of_measure_container').empty();

        $('.search_purchase_cost,.search_selling_cost,.search_stock_quantity,.purchase_total,.grand_total,.closing_due').val('');

        $('.grand_total').val($('.opening_due').val());

        $('.stock_id').empty().append('<option selected="" disabled="" value="">- Select -</option>');

        $.each( ui.item.stocks , function( key, value ) {
            $('.stock_id').append('<option title="'+value.title+'" purchase_cost="'+value.purchase_cost+'" selling_cost="'+value.selling_cost+'" opening_stock="'+value.opening_stock+'" value='+key+'>'+value.dimention+'</option>');
            $('.stock_id_details').empty().html('( '+value.title+' )');
        });

      }
    });

    $( ".search_supplier_name" ).autocomplete({
      source: "/search/supplier_name",
      minLength: 1,
      response: function(event, ui) {
            if (ui.content.length === 0) {

                $(this).parent().addClass('has-error');
                $(this).next().removeClass('glyphicon-ok').addClass('glyphicon-remove');
                $(".search_supplier_name_empty").show();
                $('.form_submit').hide();

            } else {
                $(".search_supplier_name_empty").hide();
                $('.form_submit').show();
            }
        },
      select: function(event, ui) {
        $('.search_supplier_id').val(ui.item.id);
        $('.search_supplier_name').val(ui.item.value);
        $('.search_supplier_address').val(ui.item.supplier_address);
        $('.search_supplier_contact1').val(ui.item.supplier_contact1);

        $('.opening_balance').val(ui.item.balance);
        $('.opening_due').val(ui.item.due);

        $('.grand_total').val( parseInt(ui.item.due) - parseInt(ui.item.balance) );

        var e = $.Event('keyup'); $('.change_purchase_quantity,.sales_payment,.stock_id').trigger(e);

      }
    });

    $('.search_purchase_cost').on('keyup',function(){
       var e = $.Event('keyup'); $('.change_purchase_quantity').trigger(e);
    });

    $('.search_selling_cost').on('keyup',function(){
       var e = $.Event('keyup'); $('.change_sales_quantity').trigger(e);
    });

    $( ".search_supplier_name" ).on('keyup',function(){
        $(".search_supplier_name_empty").hide();
    });

    $( ".search_stock_name" ).autocomplete({
      source: "/search/stock_name",
      minLength: 1,
      response: function(event, ui) {
            if (ui.content.length === 0) {

                $(this).parent().addClass('has-error');
                $(this).next().removeClass('glyphicon-ok').addClass('glyphicon-remove');
                $(".search_stock_name_empty").show();
                $('.form_submit').hide();

            } else {
                $(".search_stock_name_empty").hide();
                $('.form_submit').show();
            }
        },
      select: function(event, ui) {
        $('.search_stock_id').val(ui.item.stock_id);
        $('.search_stock_name').val(ui.item.value);
        $('.search_purchase_cost').val(ui.item.purchase_cost);
        $('.search_selling_cost').val(ui.item.selling_cost);
        $('.search_stock_quantity').val(ui.item.stock_quantity);
        $('.category_id').val(ui.item.category_id);

        
      }
    });

    $( ".search_stock_name" ).on('keyup',function(){
        $(".search_stock_name_empty").hide();
    });

    $('.change_purchase_quantity').on('keyup',function(){

        var purchase_quantity = parseInt( $(this).val() );
        var purchase_cost = parseInt($('.search_purchase_cost').val());
        var opening_stock = parseInt($('.search_stock_quantity').val());

        var purchase_total = (purchase_quantity * purchase_cost);

        $('.purchase_total').val(purchase_total || '');

        $('.closing_stock').val(purchase_quantity + opening_stock || '');

        var grand_total = purchase_total + parseInt($('.opening_due').val()) - parseInt($('.opening_balance').val());

        $('.grand_total').val(grand_total || '');

        var e = $.Event('keyup'); $('.purchase_payment,.sales_payment').trigger(e);

    });

    $('.change_sales_quantity').on('keyup',function(){

        var sales_quantity = parseInt( $(this).val() );
        var sales_cost = parseInt($('.search_selling_cost').val());
        var opening_stock = parseInt($('.search_stock_quantity').val());
        var sales_total = (sales_quantity * sales_cost);
        var grand_total = sales_total + parseInt($('.opening_due').val()) - parseInt($('.opening_balance').val());

        $('.sales_total').val(sales_total || '');

        $('.closing_stock').val(opening_stock - sales_quantity);

        $('.grand_total').val(grand_total || '');

        if(grand_total < 0){
            $('.closing_balance').val(parseInt($('.opening_balance').val()) - sales_total + parseInt($('.opening_due').val()));
        }else{
            $('.closing_due').val('');    
        }
        
    });
   
    $('.change_sales_quantity').on('keyup change mouseout',function(){

        var e = $.Event('keyup'); $('.sales_discount_percent,.sales_discount_amount,.sales_tax_percent,.sales_tax_amount,.purchase_payment').trigger(e);

        if( parseInt( $(this).val() ) > parseInt( $(this).attr('max') ) ){
            $(this).parent().addClass('has-error');
            $(this).next().removeClass('glyphicon-ok').addClass('glyphicon-remove');
            $('.form_submit').hide();
            $('.max_stock').show();
        }else{
            $('.form_submit').show();
            $('.max_stock').hide();
        }
    });

    $('.sales_payment').on('keyup',function(){

        var payment = parseInt($(this).val());
        var grand_total = parseInt($('.grand_total').val());
        var opening_balance = parseInt($('.opening_balance').val());
        var opening_due = parseInt($('.opening_due').val());

        if( (grand_total - payment) > 0 ){
            $('.closing_due').val(grand_total - payment);
            $('.closing_balance').val(0);
        }
        else{
            $('.closing_due').val(0);
            $('.closing_balance').val(payment - grand_total || '');
        }

        
    });

    $('.purchase_payment').on('keyup',function(){

        var payment = parseInt($(this).val());
        var grand_total = parseInt($('.grand_total').val());
        var opening_balance = parseInt($('.opening_balance').val());
        var opening_due = parseInt($('.opening_due').val());

        if( (grand_total - payment) > 0 ){
            $('.closing_due').val(grand_total - payment);
            $('.closing_balance').val(0);
        }
        else{
            $('.closing_due').val(0);
            $('.closing_balance').val(payment - grand_total);
        }

        
    });

    /* Sales */

    $( ".search_customer_name" ).autocomplete({
      source: "/search/customer_name",
      minLength: 1,
      response: function(event, ui) {
            if (ui.content.length === 0) {

                $(this).parent().addClass('has-error');
                $(this).next().removeClass('glyphicon-ok').addClass('glyphicon-remove');
                $(".search_customer_name_empty").show();
                $('.form_submit').hide();

            } else {
                $(".search_customer_name_empty").hide();
                $('.form_submit').show();
            }
        },
      select: function(event, ui) {
        $('.search_customer_id').val(ui.item.id);
        $('.search_customer_name').val(ui.item.value);
        $('.search_customer_address').val(ui.item.customer_address);
        $('.search_customer_contact1').val(ui.item.customer_contact1);

        $('.opening_balance').val(ui.item.balance);
        $('.opening_due').val(ui.item.due);

        $('.grand_total').val( parseInt(ui.item.due) - parseInt(ui.item.balance) );
      }
    });

    $( ".search_customer_name" ).on('keyup',function(){
        $(".search_customer_name_empty").hide();
    });

    $('.sales_discount_percent').on('keyup',function(){

        var discount_percent = parseInt($(this).val()); 
        var sub_total = parseInt($('.sales_total').val());
        var tax = parseInt($('.sales_tax_amount').val());
        var discount = parseInt( (sub_total * discount_percent)/100 );

        $('.sales_discount_amount').val(discount || 0);

        var total = parseInt($('.opening_due').val()) + parseInt($('.sales_total').val()) - parseInt($('.opening_balance').val());

        $('.grand_total').val(total-discount+tax || '');
        var e = $.Event('keyup'); $('.purchase_payment').trigger(e);

    });

    $('.sales_discount_amount').on('keyup',function(){

        var discount = parseInt($(this).val()); 
        var sub_total = parseInt($('.sales_total').val());
        var tax = parseInt($('.sales_tax_amount').val());

        var discount_percent = ((discount*100)/sub_total);

        $('.sales_discount_percent').val(discount_percent || 0);

        var total = parseInt($('.opening_due').val()) + parseInt($('.sales_total').val()) - parseInt($('.opening_balance').val());

        $('.grand_total').val(total-discount+tax || '');

        var e = $.Event('keyup'); $('.purchase_payment').trigger(e);

    });

    $('.sales_tax_percent').on('keyup',function(){

        var tax_percent = parseInt($(this).val()); 
        var sub_total = parseInt($('.sales_total').val());
        var dicount = parseInt($('.sales_discount_amount').val());

        var tax = parseInt( (sub_total * tax_percent)/100 );

        $('.sales_tax_amount').val(tax || 0);

        var total = parseInt($('.opening_due').val()) + parseInt($('.sales_total').val()) - parseInt($('.opening_balance').val());

        $('.grand_total').val(total+tax-dicount || '');

        var e = $.Event('keyup'); $('.purchase_payment').trigger(e);
    });

    $('.sales_tax_amount').on('keyup',function(){

        var tax = parseInt($(this).val()); 
        var sub_total = parseInt($('.sales_total').val());
        var dicount = parseInt($('.sales_discount_amount').val());

        var tax_percent = ((tax*100)/sub_total);

        $('.sales_tax_percent').val(tax_percent || 0);

        var total = parseInt($('.opening_due').val()) + parseInt($('.sales_total').val()) - parseInt($('.opening_balance').val());

        $('.grand_total').val(total+tax-dicount || '');
        var e = $.Event('keyup'); $('.purchase_payment').trigger(e);

    });

    /**/

    $('.create_customer').bootstrapValidator({
                
                ignore: ":hidden",
                excluded: ':disabled',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {

                    customer_name: {
                        validators: {
                            notEmpty: {
                                message: "Customer Name is required "
                            },
                            stringLength: {
                                min: 3,max: 64,message: 'Should range between 3 to 64 characters'
                            }
                        }
                    },

                    customer_email: {
                        validators: {
                            
                            emailAddress: {
                                    message: 'Email should contain @ symbol ' 
                                },
                            regexp: {
                                    regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                                    message: 'Enter valid email address'
                                },
                            stringLength: {
                                max: 64,
                                message: 'Maximum 64 characters allowed'
                            }
                        }
                    },

                    customer_contact1: {
                        validators: {
                            notEmpty: {
                                message: "Mobile number is required "
                            },
                            stringLength: {
                                min: 10,max: 11,message: 'Mobile number should contain 10 to 11 digits '
                            },
                            regexp: {
                                regexp: '^([0|\[0-9]{1,5})?([7-9][0-9]{9})$',
                                message: 'Enter valid mobile number' 
                            }
                        }
                    },

                    customer_contact2: {
                        validators: {
                            stringLength: {
                                min: 10,max: 11,message: 'Mobile number should contain  10 to 11 digits '
                            },
                            regexp: {
                                regexp: '^([0|\[0-9]{1,5})?([7-9][0-9]{9})$',
                                message: 'Enter valid mobile number' 
                            }
                        }
                    },

                    customer_address: {
                        validators: {
                            notEmpty: {
                                message: 'Address is required'
                            },
                            stringLength: {
                                min: 6,
                                max: 128,
                                message: 'Should range between 6 to 128 characters'
                            },
                                              
                        }
                    }
                }
    });

    $('.create_supplier').bootstrapValidator({
                
                ignore: ":hidden",
                excluded: ':disabled',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {

                    supplier_name: {
                        validators: {
                            notEmpty: {
                                message: "Customer Name is required "
                            },
                            stringLength: {
                                min: 3,max: 64,message: 'Should range between 3 to 64 characters'
                            }
                        }
                    },

                    supplier_email: {
                        validators: {
                            
                            emailAddress: {
                                    message: 'Email should contain @ symbol ' 
                                },
                            regexp: {
                                    regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                                    message: 'Enter valid email address'
                                },
                            stringLength: {
                                max: 64,
                                message: 'Maximum 64 characters allowed'
                            }
                        }
                    },

                    supplier_contact1: {
                        validators: {
                            notEmpty: {
                                message: "Mobile number is required "
                            },
                            stringLength: {
                                min: 10,max: 11,message: 'Mobile number should contain 10 to 11 digits '
                            },
                            regexp: {
                                regexp: '^([0|\[0-9]{1,5})?([7-9][0-9]{9})$',
                                message: 'Enter valid mobile number' 
                            }
                        }
                    },

                    supplier_contact2: {
                        validators: {
                            stringLength: {
                                min: 10,max: 11,message: 'Mobile number should contain  10 to 11 digits '
                            },
                            regexp: {
                                regexp: '^([0|\[0-9]{1,5})?([7-9][0-9]{9})$',
                                message: 'Enter valid mobile number' 
                            }
                        }
                    },

                    supplier_address: {
                        validators: {
                            notEmpty: {
                                message: 'Address is required'
                            },
                            stringLength: {
                                min: 6,
                                max: 128,
                                message: 'Should range between 6 to 128 characters'
                            },
                                              
                        }
                    }
                }
    });

    $('.create_category').bootstrapValidator({
                
                ignore: ":hidden",
                excluded: ':disabled',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {

                    category_name: {
                        validators: {
                            notEmpty: {
                                message: "Category Name is required "
                            },
                            stringLength: {
                                min: 3,max: 64,message: 'Should range between 3 to 64 characters'
                            }
                        }
                    },
                    'measures[]': {
                        validators: {
                            notEmpty: {
                                message: 'Atleast one measure is required'
                            },                
                        }
                    }
                }
    });

    $('.create_stock').bootstrapValidator({
                
                ignore: ":hidden",
                excluded: ':disabled',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {

                    category_name: {
                        validators: {
                            notEmpty: {
                                message: "Category Name is required "
                            }
                        }
                    },
                    stock_name: {
                        validators: {
                            notEmpty: {
                                message: "Stock Code is required "
                            },
                            stringLength: {
                                min: 3,max: 64,message: 'Should range between 3 to 64 characters'
                            }
                        }
                    },
                    category_id: {
                        validators: {
                            notEmpty: {
                                message: 'Stock Category is required'
                            },                
                        }
                    },
                    supplier_id: {
                        validators: {
                            notEmpty: {
                                message: 'Supplier name is required'
                            },                
                        }
                    },
                    purchase_cost: {
                        validators: {
                            numeric: {
                                message: 'Enter valid number',
                                thousandsSeparator: '',
                                decimalSeparator: '.'
                            }                
                        }
                    },
                    selling_cost: {
                        validators: {
                            numeric: {
                                message: 'Enter valid number',
                                thousandsSeparator: '',
                                decimalSeparator: '.'
                            }                
                        }
                    },

                }
    });

    $('.create_sales').bootstrapValidator({
                
                ignore: ":hidden",
                excluded: ':disabled',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {

                    customer_name: {
                        validators: {
                            notEmpty: {
                                message: "Input Required"
                            }
                        }
                    },
                    stock_name: {
                        validators: {
                            notEmpty: {
                                message: "Input Required"
                            }
                        }
                    },
                    sales_quantity: {
                        validators: {
                            notEmpty: {
                                message: "Input Required"
                            },
                            integer: {
                                min:1,
                                message:'Invalid Input'
                            }
                        }
                    },
                    payment: {
                        validators: {
                            notEmpty: {
                                message: "Input Required"
                            }
                        }
                    },

                }
    });

    $('.create_purchase').bootstrapValidator({
                
                ignore: ":hidden",
                excluded: ':disabled',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {

                    supplier_name: {
                        validators: {
                            notEmpty: {
                                message: "Input Required"
                            }
                        }
                    },
                    stock_name: {
                        validators: {
                            notEmpty: {
                                message: "Input Required"
                            }
                        }
                    },
                    purchase_quantity: {
                        validators: {
                            notEmpty: {
                                message: "Input Required"
                            },
                            integer: {
                                min:1,
                                message:'Invalid Input'
                            }
                        }
                    },
                    payment: {
                        validators: {
                            notEmpty: {
                                message: "Input Required"
                            }
                        }
                    },

                }
    });

    $('.generate_report').bootstrapValidator({
                
                ignore: ":hidden",
                excluded: ':disabled',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {

                    report_type: {
                        validators: {
                            notEmpty: {
                                message: "Input Required"
                            }
                        }
                    },
                    from: {
                        validators: {
                            notEmpty: {
                                message: "Input Required"
                            },
                            date: {
                                format: 'MM/DD/YYYY',
                                message: "Invalid Date"
                            }
                        }
                    },
                    to: {
                        validators: {
                            notEmpty: {
                                message: "Input Required"
                            },
                            date: {
                                format: 'MM/DD/YYYY',
                                message: "Invalid Date"
                            }
                        }
                    },

                }
    });
    
});
