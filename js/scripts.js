jQuery(document).ready(function($){

	/**
	 * Initialize sortable
	 */
	$("#dragdrop-sortable").sortable({
		handle: ".dragdrop-sortable-item-header",
		placeholder: "dragdrop-highlight"
	});
    // $("#dragdrop-sortable").disableSelection();

    /**
     * Toggle the repeater body
     */
    $('.dragdrop-sortable-content').on('click', '.dragdrop-sortable-item-header', function(evt){
    	evt.preventDefault();
    	evt.stopPropagation();
    	$(this).parents('.dragdrop-sortable-item').toggleClass('closed');
    });

    /**
     * Update the order
     */
    function dragdropChnageItemOrder(){
    	var allDragdropItems = $('.dragdrop-sortable-content li.single-sortable-item');
    	$.each(allDragdropItems, function(index, value){
            var childItem = allDragdropItems.eq(index);
            childItem.find('input.dragdrop-set-order').val(index);
    		childItem.find('span.dragdrop-item-count').html(index+1);
    	});
    }//End of dragdropChnageItemOrder
    

    /**
     * Trigger after drop the item
     * Update the order
     */
    $("#dragdrop-sortable").on("sortupdate", function(event, ui){
    	dragdropChnageItemOrder();
    });

    /**
     * Remove an item
     */
    $('.dragdrop-sortable-content').on('click', '.remove-dragdrop-sortable', function(evt){
    	evt.preventDefault();
    	evt.stopPropagation();
    	$(this).parents('.single-sortable-item').remove();
    	dragdropChnageItemOrder();
    });

    /**
     * New Item HTML
     */
    function newDragdropHTMLContent(index){
    	var html = '<li class="ui-state-default single-sortable-item">';
			html += '<div class="dragdrop-sortable-item">';
	    		html += '<div class="dragdrop-sortable-item-header">';
					html += '<button type="button" class="handlediv" aria-expanded="true">';
						html += '<span class="dashicons dashicons-arrow-up"></span>';
					html += '</button>';
					html += '<h3 class="hndle">Store Name <span class="dragdrop-item-count">'+ (index+1) +'</span></h3>';
					html += '<button type="button" class="remove-dragdrop-sortable header-dragdrop-remove-icon"><span class="dashicons dashicons-no-alt"></span></button>';
				html += '</div>';
	    		html += '<div class="dragdrop-sortable-item-body">';
		    		html += '<table class="wp-list-table widefat fixed striped">';
		    			html += '<thead>';
							html += '<tr>';
								html += '<th>Column 1</th>';
								html += '<th>Column 2</th>';
								html += '<th>Column 3</th>';
							html += '</tr>';
						html += '</thead>';
		    			html += '<tbody>';
			    			html += '<tr>';
			    				html += '<td><select class="select2-text-select newrow-select2" name="test_dragdrop['+index+'][column_1]">';
                                    html += '<option value="AL">Alabama</option>';
                                    html += '<option value="AL">Andorra</option>';
                                    html += '<option value="AL">Australia</option>';
                                    html += '<option value="AL">Bangladesh</option>';
                                    html += '<option value="AL">Belgium</option>';
                                    html += '<option value="AL">Brazil</option>';
                                    html += '<option value="WY">China</option>';
                                    html += '<option value="WY">Ghana</option>';
                                    html += '<option value="WY">India</option>';
                                    html += '<option value="WY">Japan</option>';
                                    html += '<option value="WY">Macau</option>';
                                    html += '<option value="WY">Wyoming</option>';
                                html += '</select></td>';
			    				html += '<td><input type="text" class="widefat" name="test_dragdrop['+index+'][column_2]"></td>';
			    				html += '<td><input type="text" class="widefat" name="test_dragdrop['+index+'][column_3]"></td>';
			    			html += '</tr>';
		    			html += '</tbody>';
		    		html += '</table>';
		    		html += '<div class="dragdrop-sortable-item-bottom">';
						html += '<button type="button" class="button remove-dragdrop-sortable">Remove Store</button>';
					html += '</div>';
	    		html += '</div>';
	    		html += '<input type="hidden" name="test_dragdrop['+index+'][order]" value="'+index+'" class="dragdrop-set-order">';
    		html += '</div>';
		html += '</li>';
    	return html;
    }//End newDragdropHTMLContent

    /**
     * Add New Item
     */
	$('.dragdrop-sortable-content').on('click', '.add-dragdrop-sortable', function(evt){
    	evt.preventDefault();
    	evt.stopPropagation();
    	var allDragdropItems = $('.dragdrop-sortable-content li.single-sortable-item');
    	var newItem = newDragdropHTMLContent(allDragdropItems.length);
    	$('#dragdrop-sortable').append(newItem); //Item added
        
        // Re-initialize select2 for new item
        $('.select2-text-select.newrow-select2').select2({
            width: '100%'
        });

        // Remove extra class from select tag
        setTimeout(function(){
            $('select.select2-text-select.newrow-select2').removeClass('newrow-select2');
        }, 500);
        
    });

	/**
	 * Set the height of drop placeholder
	 */
	$("#dragdrop-sortable").on("sortstart", function(event, ui){
		var height = ui.item.height();
		$('#dragdrop-sortable li.dragdrop-highlight').height(height);
	});

    /**
     * Initialize select2 
     */
	$('.select2-text-select').select2({
        width: '100%'
    });

}); //End of DOM ready
