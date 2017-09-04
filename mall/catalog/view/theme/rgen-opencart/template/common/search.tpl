<?php $rgen = $this->rgen('settings'); ?>
<div id="search">
	<span class="input-wrp">
		<input style="font-size: 17px" type="text" name="search" id="autosearch" value="<?php echo $search; ?>" placeholder="請輸入文字搜尋商品" />
	</span>
	<span class="btn-wrp">
		<button type="button" class="search-btn"><i class="fa fa-search"></i></button>
	</span>
</div>

<?php if ($rgen['topbar_autosearch']) { ?>
<script>ajaxSearch('#autosearch');</script>	
<?php } ?>
