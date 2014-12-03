<?php echo $this->form('search-form', $options['form_attributes']); ?>
<?php echo $this->formText('query', $filters['query'], array('title' => __('Search'), 'placeholder' => '..search this exhibit by keyword..')); ?>


<fieldset id="advanced-form">
<fieldset id="query-types">
<p><?php echo __('Search using this query type:'); ?></p>
<?php echo $this->formRadio('query_type', $filters['query_type'], null, $query_types); ?><br>
<?php echo $this->formRadio('record_types[]', $filters['record_types'], null, $record_types); ?>
<br>
<?php echo $this->formRadio('exhibit_id',$filters['exhibit_id'], array('checked' => 'checked'), $exhibit_id); ?>
</p>
</fieldset>



</fieldset>

<?php echo $this->formButton('submit_search', __('Search'), array('type' => 'submit')); ?>
</form>