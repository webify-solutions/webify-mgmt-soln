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
        <li><?= $this->Html->link(__('New Product'), ['controller' => 'Product', 'action' => 'add']) ?></li>
        <li><?= $this->Form->postLink(
                __('Delete Product'),
                [
                    'controller' => 'Product',
                    'action' => 'delete',
                    $product->id
                ],
                [
                    'confirm' => __('Are you sure you want to delete {0}?', $product->name)
                ]
            )
        ?></li>
    </ul>
</nav>
<div class="product form large-9 medium-8 columns content">
    <?= $this->Form->create($product) ?>
    <fieldset>
      <legend><?= __('Edit Product') ?></legend>
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

        echo $this->Form->control(
          'category_name',
          [
            'id' => 'category-name',
            'value' => $product->has('product_category') ? $product->product_category->name : null,
            'data-custom-fields' => $categoriesCustomFields
          ]
        );
        $categoriesCustomFieldsMap = json_decode($categoriesCustomFields, true);
        // debug($categoriesCustomFieldsMap);
        // debug($product->category_id);
        $firstNull = $product->category_id == null ;
        for ($i = 1; $i <= 20; $i++) {
          $id = 'custom-field-' . $i;
          $key = 'custom_field_' . $i;
          $key2 = 'custom_field_type_' . $i;
          // debug($categoriesCustomFieldsMap[$product->category_id][$key]);
          if ($product->category_id != null and $categoriesCustomFieldsMap[$product->category_id][$key] != null) {
            $firstNull = false;
            echo '<div id="div-custom-field-' . $i . '">';
            echo '  <div class="input text custom-field">';
            echo '    <label for="custom-field-' . $i . '">Extra Field Name <a href="#" id="delete-custom-field-' . $i . '">Delete</a></label>';
            echo '    <input type="text" name="custom_field_' . $i . '" id="custom-field-' . $i . '" value="' . ($categoriesCustomFieldsMap[$product->category_id][$key]) . '"/>';
            echo '  </div>';
            echo '  <div class="input text custom-field">';
            echo '    <label for="custom-field-type-' . $i . '">Extra Field Type</label>';
            echo '    <select name="custom_field_type_' . $i . '" id="custom-field-type-' . $i . '">';
            foreach ($categoriesCustomFieldTypes as $key3 => $value3) {
              echo '    <option value="' . $key3 . '" ' . ($categoriesCustomFieldsMap[$product->category_id][$key2] == $key3 ? 'selected="selected"' : '') . '>' . $value3 . '</option>';
            }
            echo '    </select>';
            echo '  </div>';
            echo '</div>';
          } else {
            echo '<div id="div-custom-field-' . $i . '"' . ($firstNull ? ' class="hidden"' : '') . '>';
            echo '  <div class="input text custom-field">';
            echo '    <label for="custom-field-' . $i . '">Extra Field Name <a href="#" id="delete-custom-field-' . $i . '">Delete</a></label>';
            echo '    <input type="text" name="custom_field_' . $i . '" id="custom-field-' . $i . '"/>';
            echo '  </div>';
            echo '  <div class="input text custom-field">';
            echo '    <label for="custom-field-type-' . $i . '">Extra Field Type</label>';
            echo '    <select name="custom_field_type_' . $i . '" id="custom-field-type-' . $i . '">';
            foreach ($categoriesCustomFieldTypes as $key3 => $value3) {
              echo '    <option value="' . $key3 . '">' . $value3 . ' </option>';
            }
            echo '    </select>';
            echo '  </div>';
            echo '</div>';
            $firstNull = true;
          }
        }

        // for ($i = 1; $i <= 20; $i++) {
        //   echo '<div id="div-custom-field-' . $i . '" class="hidden">';
        //   echo '  <div class="input text">';
        //   echo '    <label for="custom-field-' . $i . '">Extra Field Name <a href="#" id="delete-custom-field-' . $i . '">Delete</a></label>';
        //   echo '    <input type="text" name="custom_field_' . $i . '" id="custom-field-' . $i . '"/>';
        //   echo '  </div>';
        //   echo '  <div class="input text">';
        //   echo '    <label for="custom-field-type-' . $i . '">Extra Field Type</label>';
        //   echo '    <select name="custom_field_type_' . $i . '" id="custom-field-type-' . $i . '">';
        //   foreach ($categoriesCustomFieldTypes as $key => $value) {
        //     echo '    <option value="' . $key . '"> ' . $value . '</option>';
        //   }
        //   echo '    </select>';
        //   echo '  </div>';
        //   echo '</div>';
        // }
      ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

<?php $this->Html->script('Product/edit.js', ['block' => 'scriptBottom']); ?>
<?php $this->Html->script('jquery-ui.min.js', ['block' => 'scriptBottom']) ?>
<?php $this->Html->css('jquery-ui.min.css', ['block' => 'cssBottom']) ?>
