<option value="<?= $category['id'] ?>"
    <?php /*Выбираем родительскую категорию сразу*/
    if ($category['id'] == $this->model->parent_id) echo ' selected'?>
    <?php /*Убираем собственную категорию */
    if ($category['id'] == $this->model->id) echo ' disabled'?>
    >
    <?= $tab . $category['name'] ?>
</option>

<?php if (isset($category['childs'])):?>
    <ul>
        <!--При вызове рекурсивно функции добавляем тире в начале наименования-->
        <?= $this->getMenuHtml($category['childs'], $tab. '-'); ?>
    </ul>
<?php endif; ?>