<?php
	global $post;
	$test_dragdrop = get_post_meta($post->ID, 'test_dragdrop', true);
	$select_conutry = ['Alabama', 'Andorra', 'Australia', 'Bangladesh', 'Belgium', 'Brazil', 'China', 'Ghana', 'India', 'Japan', 'Macau', 'Wyoming'];
?>
<div class="dragdrop-sortable-content">
	<ul id="dragdrop-sortable">
		
		<?php if(is_array($test_dragdrop) && !empty($test_dragdrop)): foreach($test_dragdrop as $index => $item): ?>
		
		<li class="ui-state-default single-sortable-item">
			<div class="dragdrop-sortable-item closed">
				<div class="dragdrop-sortable-item-header">
					<button type="button" class="handlediv" aria-expanded="true">
						<span class="dashicons dashicons-arrow-up"></span>
					</button>
					<h3 class="hndle">Store Name <span class="dragdrop-item-count"><?= $item['order'] + 1; ?></span></h3>
					<button type="button" class="remove-dragdrop-sortable header-dragdrop-remove-icon">
						<span class="dashicons dashicons-no-alt"></span>
					</button>
				</div>
				<div class="dragdrop-sortable-item-body">
					<table class="wp-list-table widefat fixed striped">
						<thead>
							<tr>
								<th>Column 1</th>
								<th>Column 2</th>
								<th>Column 3</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<?php $column_1 =  empty($item['column_1']) ? '' : $item['column_1']; ?>
									<select class="select2-text-select" name="test_dragdrop[<?= $index; ?>][column_1]">
										<?php foreach($select_conutry as $conutry): ?>
										<option value="<?= $conutry; ?>" <?php selected($conutry, $column_1); ?>><?= $conutry; ?></option>
										<?php endforeach; ?>
									</select>
								</td>
								<td><input type="text" class="widefat" name="test_dragdrop[<?= $index; ?>][column_2]" value="<?= empty($item['column_2']) ? '' : $item['column_2']; ?>"></td>
								<td><input type="text" class="widefat" name="test_dragdrop[<?= $index; ?>][column_3]" value="<?= empty($item['column_3']) ? '' : $item['column_3']; ?>"></td>
							</tr>
						</tbody>
					</table>
					<div class="dragdrop-sortable-item-bottom">
						<button type="button" class="button remove-dragdrop-sortable">Remove Store</button>
					</div>
				</div>
				<input type="hidden" name="test_dragdrop[<?= $index; ?>][order]" value="<?= $index; ?>" class="dragdrop-set-order">
			</div>
		</li>

		<?php endforeach; else: //If array is empty or not set ?>
		
		<li class="ui-state-default single-sortable-item">
			<div class="dragdrop-sortable-item">
				<div class="dragdrop-sortable-item-header">
					<button type="button" class="handlediv" aria-expanded="true">
						<span class="dashicons dashicons-arrow-up"></span>
					</button>
					<h3 class="hndle">Store Name <span class="dragdrop-item-count">1</span></h3>
					<button type="button" class="remove-dragdrop-sortable header-dragdrop-remove-icon">
						<span class="dashicons dashicons-no-alt"></span>
					</button>
				</div>
				<div class="dragdrop-sortable-item-body">
					<table class="wp-list-table widefat fixed striped pages">
						<thead>
							<tr>
								<th>Column 1</th>
								<th>Column 2</th>
								<th>Column 3</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<select class="select2-text-select" name="test_dragdrop[0][column_1]">
										<?php foreach($select_conutry as $conutry): ?>
										<option value="<?= $conutry; ?>"><?= $conutry; ?></option>
										<?php endforeach; ?>
									</select>
								</td>
								<td><input type="text" class="widefat" name="test_dragdrop[0][column_2]"></td>
								<td><input type="text" class="widefat" name="test_dragdrop[0][column_3]"></td>
							</tr>
						</tbody>
					</table>
					<div class="dragdrop-sortable-item-bottom">
						<button type="button" class="button remove-dragdrop-sortable">Remove Store</button>
					</div>
				</div>
				<input type="hidden" name="test_dragdrop[0][order]" value="0" class="dragdrop-set-order">
			</div>
		</li>

		<?php endif; ?>

	</ul> <!-- /#dragdrop-sortable -->

	<button type="button" class="button add-dragdrop-sortable">Add New Store</button>
</div>