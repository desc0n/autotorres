<div class="row">
	<p>
	<form>
		<div class="text-muted col-sm-12">Страница:</div>
		<div class="col-sm-6">
			<select class="form-control" name="slug">
				<option value="0">не выбрано</option>
                <?foreach($pages as $page) {
					if(!$page['redact_access']) {
						continue;
					}?>
				<option value="<?=$page['slug'];?>" <?=(Arr::get($get, 'slug') === $page['slug'] ? 'selected' : '');?>><?=$page['name'];?></option>
                <?}?>
			</select>
		</div>
		<button class="btn btn-default" type="submit">Выбрать</button>
	</form>
	</p>
	<form class="form-horizontal row" style="display:inline-block;margin-left:40px;" method="post">
		<p>
			<div class="row">
				<h3>Редактируем страницу</h3>
			</div>
		</p>
        <p>
			<div class="form-group span12">
				<label for="inputContent">Текст страницы</label>
				<textarea id="inputContent" name="content" class="ckeditor"><?=Arr::get($pageData, 'content', '');?></textarea>
			</div>
		</p>
		<p>
			<div class="row">
				<button type="submit" class="btn btn-primary" name="redactpage" value="<?=Arr::get($get, 'slug');?>">Сохранить</button>
			</div>
		</p>
	</form>
</div>
<script src="/public/js/ckeditor/ckeditor.js"></script>