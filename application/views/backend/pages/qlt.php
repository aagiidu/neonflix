<style>
	.checkbox{width: 40px}
	.qlt label{float:left;margin-right:10px}
</style>
<div class="form-group clearfix">
<label class="form-label">Нягтшил </label>
<div class="controls qlt">
    <label>
        <input type="checkbox" class="form-control checkbox" name="qlt[]" value="1080" <?php if ( strpos($row["qlt"], '1080') > -1 ) echo 'checked';?> /> 1080p
    </label>
    <label>
        <input type="checkbox" class="form-control checkbox" name="qlt[]" value="720" <?php if ( strpos($row["qlt"], '720') > -1 ) echo 'checked';?> /> 720p
    </label>
    <label>
        <input type="checkbox" class="form-control checkbox" name="qlt[]" value="480" <?php if ( strpos($row["qlt"], '480') > -1 ) echo 'checked';?> /> 480p
    </label>
    <label>
        <input type="checkbox" class="form-control checkbox" name="qlt[]" value="360" <?php if ( strpos($row["qlt"], '360') > -1 ) echo 'checked';?> /> 360p
    </label>
</div>
</div>