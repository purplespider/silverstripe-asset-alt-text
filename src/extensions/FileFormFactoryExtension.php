<?php

namespace PurpleSpider\AssetAltText;

use SilverStripe\Core\Extension;
use SilverStripe\Forms\Tip;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TippableFieldInterface;

class FileFormFactoryExtension extends Extension
{
    public function updateFormFields(FieldList $fields, $controller, $formName, $context): void
    {
        $image = $context['Record'] ?? null;
        if ($image && $image->appCategory() === 'image') {

            $altTextField = TextField::create('AltText', 'Alternative text (alt)');
            $altTextDescription = _t(
                'SilverStripe\\AssetAdmin\\Controller\\AssetAdmin.AltTextTip',
                'Description for visitors who are unable to view the image (using screenreaders or ' .
                'image blockers). Recommended for images which provide unique context to the content.'
            );

            if ($altTextField instanceof TippableFieldInterface) {
                $altTextField->setTip(new Tip($altTextDescription, Tip::IMPORTANCE_LEVELS['HIGH']));
            } else {
                $altTextField->setDescription($altTextDescription);
            }

            $titleField = $fields->fieldByName('Editor.Details.Title');
            if ($titleField) {
                if ($titleField->isReadonly()) $altTextField = $altTextField->performReadonlyTransformation();
                $fields->insertAfter(
                    'Title',
                    $altTextField
                );
            }
        }
    }
}
