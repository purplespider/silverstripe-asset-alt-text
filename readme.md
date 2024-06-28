# Asset Alt Text for Silverstripe

Adds an alternative text field to Image assets, so that you don't need to use the image `Title` field (which would typically be more succinct than useful alt text).

As a bonus feature, when adding an image to an `HTMLEditorField`, the alt text field gets pre-filled with any asset alt text.

## Usage

Install via composer `composer require purplespider/asset-alt-text`

`dev/build`

Go to the **Files** and select an image to see the new field:

<img src="https://p.spdr.me/Fl55qH+" width="500">


To make use of the alt text value in your templates, just use `$AltText`. e.g.:
````
<% with BannerImage %>
    <img src="$URL" width="$Width" height="$Height" alt="$AltText" />
<% end_with %>
````
