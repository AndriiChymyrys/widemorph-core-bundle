## FormBuilder

### Purpose
Allow to override form fields.

You can use standard symfony approach to build form, but in this case you will lose ability to override filed from 
another bundle.

By using `FormBuilder` from Morph package you can override fields, add new fields, remove fields, change filed orders.

### Example
```php
const FORM_BUILDER_NAME = 'imsCreateProductForm';

$formBuilder
            ->resetFields()
            ->add('name', TextType::class)
            ->add('description', TextType::class, 2)
            ->add('save', SubmitType::class, 3)
            ->build($builder, static::FORM_BUILDER_NAME);
```

`add` method of `FormBuilderService` have signature `public function add(string $field, string $type = null, int $priority = 1, array $options = []): self`

* `$field` - symfony form filed name
* `$type` - symfony form field type
* `$priority` - all fields will be sorted by priority in asc order
* `$options` - symfony form options

### Override
Before a symfony form will be builded event `WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Event\FormBuilderFieldsEvent` will be fired.
Event name will be generated from `FORM_BUILDER_NAME`. For example above event name will be `morph.form.field.builder.imsCreateProductForm`.

### Event
Event class `WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Event\FormBuilderFieldsEvent` has methods:

* `setFields(array $fields)`: to override all form fields
* `addNewField(string $field, string $type = null, int $priority = 1, array $options = [])`: to add new field to form
* `removeField(string $field)`: to remove filed from form

### Event example
```php
// FormBuilderFieldsEvent
$event->addNewField(
            'category',
            EntityType::class,
            2,
            [
                'class' => $this->morphCoreInteraction->getEntityResolver()->getEntityName('Category'),
                'choice_label' => 'name',
                'attr' => [
                    'class' => 'form-control'
                ]
            ]
        );
```
