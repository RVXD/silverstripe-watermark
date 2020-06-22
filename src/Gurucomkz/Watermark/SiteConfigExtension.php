<?php

namespace Gurucomkz\Watermark;

use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldGroup;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataExtension;

class SiteConfigExtension extends DataExtension {
    private static $db = [
        'WatermarkPosition' => 'Enum("Top,Right,Left,Center,TopLeft,TopRight,BottomRight,BottomLeft","BottomRight")',
        'WatermarkMaxWidth' => 'Int',
        'WatermarkMaxHeight' => 'Int',
        'WatermarkXOffset' => 'Int',
        'WatermarkYOffset' => 'Int',
    ];

    private static $has_one = [
        'WatermarkImage' => Image::class,
    ];
    private static $owns = [
        'WatermarkImage',
    ];

    public function updateCMSFields(FieldList $fields) {
        $fields->removeByName('Tagline');
        $fields->addFieldsToTab('Root.Watermarking', [
            UploadField::create('WatermarkImage'),
            DropdownField::create('WatermarkPosition','Watermark position',$this->owner->dbObject('WatermarkPosition')->enumValues()),
            FieldGroup::create('Watermark max size',[
                TextField::create('WatermarkMaxWidth','Width (%)'),
                TextField::create('WatermarkMaxHeight','Height (%)'),
            ])
            ->setDescription('No watermark will appear of one if these is zero.'),
            FieldGroup::create('Watermark offset',[
                TextField::create('WatermarkXOffset','Horizontal Offset'),
                TextField::create('WatermarkYOffset','Vertical Offset'),
            ]),
        ]);
    }
}
