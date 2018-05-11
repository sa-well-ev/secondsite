<option value="<?= $category['id'] ?>"
    <?php /*Выбираем родительскую категорию сразу*/
    if ($category['id'] == $this->model->category_id) echo ' selected'?>
>
    <?= $tab . $category['name'] ?>
</option>

<?php if (isset($category['childs'])):?>
    <ul>
        <!--При вызове рекурсивно функции добавляем тире в начале наименования-->
        <?= $this->getMenuHtml($category['childs'], $tab. '-'); ?>
    </ul>
<?php endif; ?>