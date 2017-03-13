$( document ).ready(function() {

    $(document).on('click', '.add_sales_product', function(){

        $('.sales_container').append('<tr><td><input type="text" class="form-control search_purchase_category_name" placeholder="Type here ..." name="category_name" autocomplete="off"><span class="help-block search_purchase_category_name_empty glyphicon" style="display: none;"> No Results Found </span><input type="hidden" class="search_category_id" name="category_id"></td><td width="250px"><select class="form-control stock_id" name="stock_id"><option selected="" disabled="" value="">select</option></select></td><td width="200px"><input type="text" class="form-control search_purchase_cost" name="purchase_cost" readonly=""></td><td width="150px"><input type="text" class="form-control search_selling_cost" name="selling_cost" ></td><td width="100px"><input type="text" class="form-control search_stock_quantity" name="opening_stock" readonly=""></td><td width="50px"><input type="number" class="form-control change_sales_quantity" name="sales_quantity" min="1"></td><td><button type="button" class="btn btn-danger remove_tr">&times;</button></td></tr>');

        $( ".search_purchase_category_name" ).autocomplete({
          source: "/search/purchase_category_name",
          minLength: 1,
          response: function(event, ui) {
                if (ui.content.length === 0) {

                    $(this).parent().addClass('has-error');
                    $(this).next().removeClass('glyphicon-ok').addClass('glyphicon-remove');
                    $(this).next().show();
                    $('.form_submit').hide();

                } else {
                    $(this).next().hide();
                    $('.form_submit').show();
                }
            },
          select: function(event, ui) {

            $(this).next().next().val(ui.item.id);

            var select = $(this).parent().next().children(':first-child');
            
            select.empty().append('<option selected="" disabled="" value="">- Select -</option>');

            $.each( ui.item.stocks , function( key, value ) {
                select.append('<option title="'+value.title+'" purchase_cost="'+value.purchase_cost+'" selling_cost="'+value.selling_cost+'" opening_stock="'+value.opening_stock+'" value='+key+'>'+value.dimention+'</option>');
            });

          }
        });
    });

    $(document).on('click', '.remove_tr', function(){
        $(this).closest('tr').remove();
    });

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
        $('.search_stock_quantity').val($(this).find(':selected').attr('opening_stock')).html('( '+$(this).find(':selected').attr('opening_stock')+' )');

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

        $('.opening_balance').val(parseFloat(ui.item.balance).toFixed(2));
        $('.opening_due').val(parseFloat(ui.item.due).toFixed(2));

        $('.grand_total').val(  parseFloat(ui.item.due-ui.item.balance).toFixed(2) );

        // var e = $.Event('keyup'); $('.change_purchase_quantity,.sales_payment,.stock_id').trigger(e);

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

        var purchase_quantity =  parseFloat( $(this).val() || 0 ).toFixed(2);
        var purchase_cost =  parseFloat($('.search_purchase_cost').val() || 0).toFixed(2);
        var opening_stock =  parseFloat($('.search_stock_quantity').val() || 0).toFixed(2);
        var opening_balance =  parseFloat($('.opening_balance').val() || 0 ).toFixed(2);
        var opening_due =  parseFloat($('.opening_due').val() || 0).toFixed(2);

        var purchase_total = parseFloat(purchase_quantity * purchase_cost).toFixed(2);

        $('.purchase_total').val(purchase_total);

        var closing = parseFloat(purchase_quantity + opening_stock).toFixed(2);

        $('.closing_stock').val(closing);

        var grand_total = (parseFloat(purchase_total) + parseFloat(opening_due) - parseFloat(opening_balance)).toFixed(2);

        $('.grand_total').val(grand_total);

        var e = $.Event('keyup'); $('.purchase_payment,.sales_payment').trigger(e);

    });

    $('.change_sales_quantity').on('keyup',function(){

        var sales_quantity =  parseFloat( $(this).val() || 0 ).toFixed(2);
        var sales_cost =  parseFloat($('.search_selling_cost').val()).toFixed(2);
        var opening_stock =  parseFloat($('.search_stock_quantity').val()).toFixed(2);
        var sales_total = (parseFloat(sales_quantity) * parseFloat(sales_cost)).toFixed(2);
        var grand_total = (parseFloat(sales_total) + parseFloat($('.opening_due').val()) - parseFloat($('.opening_balance').val())).toFixed(2);

        $('.sales_total').val(sales_total || '');

        $('.closing_stock').val(opening_stock - sales_quantity);

        $('.grand_total').val(grand_total || '');

        if(grand_total < 0){

            var closing = (parseFloat( $('.opening_balance').val() ) - sales_total + parseFloat( $('.opening_due').val() )).toFixed(2);

            $('.closing_balance').val(closing);

        }else{
            $('.closing_due').val('');    
        }
        
    });
   
    $('.change_sales_quantity').on('keyup change mouseout',function(){

        var e = $.Event('keyup'); $('.sales_discount_percent,.sales_discount_amount,.sales_tax_percent,.sales_tax_amount,.purchase_payment').trigger(e);

        if(  parseInt( $(this).val() ) >  parseInt( $(this).attr('max') ) ){
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

        var payment =  parseFloat($(this).val()).toFixed(2);
        var grand_total =  parseFloat($('.grand_total').val()).toFixed(2);
        var opening_balance =  parseFloat($('.opening_balance').val()).toFixed(2);
        var opening_due =  parseFloat($('.opening_due').val()).toFixed(2);

        if( (grand_total - payment) > 0 ){
            $('.closing_due').val(grand_total - payment);
            $('.closing_balance').val(0);
        }
        else{
            $('.closing_due').val(0);
            $('.closing_balance').val( (payment - grand_total) || 0);
        }

        
    });

    $('.purchase_payment').on('keyup',function(){

        var payment =  parseFloat($(this).val() || 0).toFixed(2);
        var grand_total =  parseFloat($('.grand_total').val() || 0).toFixed(2);
        var opening_balance =  parseFloat($('.opening_balance').val() || 0).toFixed(2);
        var opening_due =  parseFloat($('.opening_due').val() || 0).toFixed(2);

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

        var grand = parseFloat(ui.item.due - ui.item.balance).toFixed(2);
        $('.grand_total').val( grand );
      }
    });

    $( ".search_customer_name" ).on('keyup',function(){
        $(".search_customer_name_empty").hide();
    });

    $('.sales_discount_percent').on('keyup',function(){

        var discount_percent = parseFloat( $(this).val() || 0).toFixed(2); 
        var sub_total = parseFloat($('.sales_total').val()).toFixed(2);
        var tax = parseFloat($('.sales_tax_amount').val()).toFixed(2);
        var discount = parseFloat( (sub_total * discount_percent)/100 ).toFixed(2);

        $('.sales_discount_amount').val(discount || 0);

        var total = (parseFloat($('.opening_due').val()) + parseFloat($('.sales_total').val()) - parseFloat($('.opening_balance').val())).toFixed(2);

        var grand = (parseFloat(total-discount) + parseFloat(tax)).toFixed(2);

        $('.grand_total').val( grand || '');
        var e = $.Event('keyup'); $('.purchase_payment').trigger(e);

    });

    $('.sales_discount_amount').on('keyup',function(){

        var discount = parseFloat($(this).val() || 0).toFixed(2); 
        var sub_total = parseFloat($('.sales_total').val() || 0).toFixed(2);
        var tax = parseFloat($('.sales_tax_amount').val() || 0).toFixed(2);
        var discount_percent = ((discount*100)/sub_total || 0).toFixed(2);

        $('.sales_discount_percent').val(discount_percent || 0);

        var total = (parseFloat($('.opening_due').val()) + parseFloat($('.sales_total').val()) - parseFloat($('.opening_balance').val())).toFixed(2);

        var grand = (parseFloat(total-discount) + parseFloat(tax)).toFixed(2);
        $('.grand_total').val( grand || '');

        var e = $.Event('keyup'); $('.purchase_payment').trigger(e);

    });

    $('.sales_tax_percent').on('keyup',function(){

        var tax_percent = parseFloat($(this).val() || 0).toFixed(2); 
        var sub_total = parseFloat($('.sales_total').val() || 0).toFixed(2);
        var discount = parseFloat($('.sales_discount_amount').val() || 0).toFixed(2);

        var tax = parseFloat( (sub_total * tax_percent)/100 || 0 ).toFixed(2);

        $('.sales_tax_amount').val(tax || 0);

        var total = (parseFloat($('.opening_due').val()) + parseFloat($('.sales_total').val()) - parseFloat($('.opening_balance').val())).toFixed(2);

        var grand = (parseFloat(total-discount) + parseFloat(tax)).toFixed(2);

        $('.grand_total').val( grand || '');

        var e = $.Event('keyup'); $('.purchase_payment').trigger(e);
    });

    $('.sales_tax_amount').on('keyup',function(){

        var tax = parseFloat($(this).val() || 0).toFixed(2); 
        var sub_total = parseFloat($('.sales_total').val() || 0).toFixed(2);
        var discount = parseFloat($('.sales_discount_amount').val() || 0).toFixed(2);

        var tax_percent = ((tax*100)/sub_total || 0).toFixed(2);

        $('.sales_tax_percent').val(tax_percent || 0);

        var total = (parseFloat($('.opening_due').val()) + parseFloat($('.sales_total').val()) - parseFloat($('.opening_balance').val())).toFixed(2);

        var grand = (parseFloat(total-discount) + parseFloat(tax)).toFixed(2);

        $('.grand_total').val( grand || '');
        var e = $.Event('keyup'); $('.purchase_payment').trigger(e);

    });

    $('.purchase_discount_percent').on('keyup',function(){

        var discount_percent = parseFloat($(this).val()).toFixed(2); 
        var sub_total = parseFloat($('.purchase_total').val()).toFixed(2);
        var tax = parseFloat($('.purchase_tax_amount').val()).toFixed(2);
        var discount = parseFloat( (sub_total * discount_percent)/100 ).toFixed(2);

        $('.purchase_discount_amount').val(discount || 0);

        var total = (parseFloat($('.opening_due').val()) + parseFloat($('.purchase_total').val()) - parseFloat($('.opening_balance').val())).toFixed(2);

        var grand = (parseFloat(total-discount) + parseFloat(tax)).toFixed(2);

        $('.grand_total').val( grand || '');
        var e = $.Event('keyup'); $('.purchase_payment').trigger(e);

    });

    $('.purchase_discount_amount').on('keyup',function(){

        var discount = parseFloat( $(this).val() ).toFixed(2); 
        var sub_total = parseFloat($('.purchase_total').val()).toFixed(2);
        var tax = parseFloat( $('.purchase_tax_amount').val() ).toFixed(2);

        var discount_percent = ((discount*100)/sub_total).toFixed(2);

        $('.purchase_discount_percent').val(discount_percent || 0);

        var total = (parseFloat($('.opening_due').val()) + parseFloat($('.purchase_total').val()) - parseFloat($('.opening_balance').val())).toFixed(2);

        var grand = (parseFloat(total-discount) + parseFloat(tax)).toFixed(2);

        $('.grand_total').val( grand || '');

        var e = $.Event('keyup'); $('.purchase_payment').trigger(e);

    });

    $('.purchase_tax_percent').on('keyup',function(){

        var tax_percent = parseFloat($(this).val()).toFixed(2); 
        var sub_total = parseFloat($('.purchase_total').val()).toFixed(2);
        var discount = parseFloat($('.purchase_discount_amount').val()).toFixed(2);

        var tax = parseFloat( (sub_total * tax_percent)/100 ).toFixed(2);

        $('.purchase_tax_amount').val(tax || 0);

        var total = ( parseFloat($('.opening_due').val()) + parseFloat($('.purchase_total').val()) - parseFloat($('.opening_balance').val()) ).toFixed(2);

        var grand = (parseFloat(total-discount) + parseFloat(tax)).toFixed(2);

        $('.grand_total').val( grand || '');

        var e = $.Event('keyup'); $('.purchase_payment').trigger(e);
    });

    $('.purchase_tax_amount').on('keyup',function(){

        var tax = parseFloat($(this).val()).toFixed(2); 
        var sub_total = parseFloat($('.purchase_total').val()).toFixed(2);
        var discount = parseFloat($('.purchase_discount_amount').val()).toFixed(2);

        var tax_percent = ((tax*100)/sub_total).toFixed(2);

        $('.purchase_tax_percent').val(tax_percent || 0);

        var total = ( parseFloat($('.opening_due').val()) + parseFloat($('.purchase_total').val()) - parseFloat($('.opening_balance').val()) ).toFixed(2);

        var grand = (parseFloat(total-discount) + parseFloat(tax)).toFixed(2);

        $('.grand_total').val( grand || '');
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
