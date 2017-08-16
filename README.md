# SvgIconBuilder
Build SVG icon from json description

## How to use
``` bash
composer require pivchenberg/svg-icon-builder
```

``` php
// create builder class
$svgIconBuilder = new SvgIconBuilder($_SERVER['DOCUMENT_ROOT'] . '/local/templates/silversite/icons.json');

// use it to generate markup of svg
echo $svgIconBuilder->build('ic-local-phone')->extendDescription([
	'class' => 'sst-svg-icon sst-svg-icon--ic-local-phone sst-margin--right-10',
	'width' => 20.7,
	'height' => 30,
])->generateMarkup();
```
### Svg json description example
``` json
{
  "ic-arrow-back": {
	"name": "ic-arrow-back",
	"width": 16,
	"height": 20,
	"viewBox": "0 0 16 20",
	"path": "M16,9H3.83l5.59-5.59L8,2l-8,8l8,8l1.41-1.41L3.83,11H16V9z"
  },
  "ic-arrow-drop-up": {
	"name": "ic-arrow-drop-up",
	"width": 10,
	"height": 20,
	"viewBox": "0 0 10 20",
	"path": "M0,12.5l5-5l5,5H0z"
  },
}
```
