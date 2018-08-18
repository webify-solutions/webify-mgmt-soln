<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Products'), ['Controller' => 'Product', 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="product form large-9 medium-8 columns content">
    <?= $this->Form->create($product) ?>
    <fieldset>
      <legend><?= __('Add Product') ?></legend>
      <?php
        if ($organization != null) {
            echo $this->Form->control('organization_id', ['options' => $organization, 'empty' => true]);
        } else if (isset($loggedUser) and isset($loggedUser['organization_id'])) {
            echo '<div class="hidden">';
            echo $this->Form->control('organization_id', ['type' => 'text']);
            echo '</div>';
        }
        echo $this->Form->control('name');
        echo $this->Form->control('sku');
        echo $this->Form->control('active');
        echo $this->Form->control('description');

        echo '<div class="hidden">';
        echo $this->Form->control('category_id', ['id' => 'category-id', 'options' => $categories, 'empty' => true]);
        echo '</div>';
        echo $this->Form->control('category_name', ['id' => 'category-name', 'data-custom-fields' => $categoriesCustomFields]);

        for ($i = 1; $i <= 20; $i++) {
          echo '<div id="div-custom-field-' . $i . '" class="hidden">';
          echo '  <div class="input text custom-field">';
          echo '    <label for="custom-field-' . $i . '">Extra Field Name <a href="#" id="delete-custom-field-' . $i . '">Delete</a></label>';
          echo '    <input type="text" name="custom_field_' . $i . '" id="custom-field-' . $i . '"/>';
          echo '  </div>';
          echo '  <div class="input text custom-field">';
          echo '    <label for="custom-field-type-' . $i . '">Extra Field Type</label>';
          echo '    <select name="custom_field_type_' . $i . '" id="custom-field-type-' . $i . '">';
          foreach ($categoriesCustomFieldTypes as $key => $value) {
            echo '    <option value="' . $key . '">' . $value . '</option>';
          }
          echo '    </select>';
          echo '  </div>';
          echo '</div>';
        }
      ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

<?php $this->Html->script('Product/add.js', ['block' => 'scriptBottom']); ?>
<?php $this->Html->script('jquery-ui.min.js', ['block' => 'scriptBottom']) ?>
<?php $this->Html->css('jquery-ui.min.css', ['block' => 'cssBottom']) ?>
