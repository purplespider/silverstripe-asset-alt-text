# Asset Alt Text for Silverstripe 4

Adds an alternative text field to Image assets, so that you don't need to use the image `Title` field (which would typically be more succinct than useful alt text).

## Usage

Install via composer `composer require purplespider/asset-alt-text`

`dev/build`

Go to Assets and select an Image to see the new field:
![](https://p.spdr.me/Fl55qH+)

To make use of the alt text in your templates, just use `$AltText`. e.g.:
````
<% with BannerImage %>
    <img src="$URL" width="$Width" height="$Height" alt="$AltText" />
<% end_with %>
````